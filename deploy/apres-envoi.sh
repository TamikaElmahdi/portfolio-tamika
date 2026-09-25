#!/usr/bin/env bash
#
# Execute sur le serveur Hostinger, juste apres l'envoi des fichiers.
# Le workflow lui transmet deux variables :
#
#   CHEMIN   dossier de l'application, par exemple /home/u528979203/domains/elmahditamika.com/public_html/portfolio
#   PHP_BIN  binaire PHP a utiliser, "php" par defaut
#
# Le script est idempotent : il peut etre rejoue sans risque.

set -euo pipefail

CHEMIN="${CHEMIN:?Le chemin de l application est manquant}"
PHP_BIN="${PHP_BIN:-php}"

cd "$CHEMIN"

echo "PHP utilise : $("$PHP_BIN" -r 'echo PHP_VERSION;')"

# Quoi qu'il arrive ensuite, le site ne reste pas ferme : un deploiement
# interrompu au milieu laisserait sinon le site en maintenance.
remettre_en_ligne() {
    "$PHP_BIN" artisan up >/dev/null 2>&1 || true
}
trap remettre_en_ligne EXIT

# ------------------------------------------------------------------
# Dossiers de travail
# ------------------------------------------------------------------
# storage/ n'est jamais transmis par rsync : on s'assure que la structure
# attendue par Laravel existe, sans toucher a ce qui s'y trouve deja.

mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chmod -R 775 storage bootstrap/cache 2>/dev/null || true

if [ ! -f .env ]; then
    echo "Le fichier .env est absent de $CHEMIN." >&2
    echo "Creez-le une premiere fois a la main, il n'est jamais transmis." >&2
    exit 1
fi

# ------------------------------------------------------------------
# Mise a jour
# ------------------------------------------------------------------

# Les anciens caches sont effaces avant la migration : une configuration
# perimee ferait pointer les commandes suivantes vers la mauvaise base.
"$PHP_BIN" artisan config:clear
"$PHP_BIN" artisan route:clear
"$PHP_BIN" artisan view:clear

"$PHP_BIN" artisan down --retry=15 || true

"$PHP_BIN" artisan migrate --force --no-interaction

# Lien public/storage vers storage/app/public, pour les images televersees.
#
# La commande artisan passe par exec() sur certains hebergements mutualises,
# ou cette fonction est desactivee. Le lien est donc pose directement, en
# relatif pour qu'il survive a un changement de chemin.
if [ ! -e public/storage ]; then
    ln -s ../storage/app/public public/storage \
        || "$PHP_BIN" artisan storage:link \
        || echo "Attention : le lien public/storage n a pas pu etre cree." >&2
fi

# ------------------------------------------------------------------
# Caches de production
# ------------------------------------------------------------------

"$PHP_BIN" artisan config:cache
"$PHP_BIN" artisan route:cache
"$PHP_BIN" artisan view:cache

# Si un worker de file d'attente tourne, il recharge le nouveau code.
"$PHP_BIN" artisan queue:restart || true

"$PHP_BIN" artisan up

echo "Deploiement termine."
