# Deploiement continu vers Hostinger

Chaque poussee sur la branche `main` lance les tests, puis publie le site.
Le pipeline est decrit dans [`.github/workflows/deploy.yml`](../.github/workflows/deploy.yml).

```
git push  ->  tests  ->  composer + npm run build  ->  rsync  ->  migrations et caches
```

Les dependances et les assets sont construits par GitHub, pas par le serveur :
un hebergement mutualise n'a ni Node ni la memoire necessaire a Composer. Le
serveur ne recoit que du code pret a servir.

> Les valeurs propres a l'hebergement (adresse IP, port, identifiant) se lisent
> dans hPanel, sous **Advanced > SSH Access**, et se rangent dans les secrets GitHub.

---

## Organisation sur le serveur

L'application vit dans `public_html/portfolio`. Le fichier
`public_html/.htaccess` sert `build/`, `storage/` et les favicons depuis
`portfolio/public`, et envoie tout le reste a `public_html/index.php`, qui
charge Laravel depuis `portfolio/`.

Le chemin a retenir pour le secret `DEPLOY_PATH` :

```
/home/u528979203/domains/elmahditamika.com/public_html/portfolio
```

Le fichier `.env` de production vit dans ce dossier. Il n'est jamais transmis
par le deploiement.

---

## 1. Ouvrir l'acces a GitHub

GitHub se connecte au serveur avec une cle dediee, differente du mot de passe SSH.

### Creer la paire de cles

Sur votre machine :

```bash
ssh-keygen -t ed25519 -C "deploiement-github-portfolio" -f ~/.ssh/portfolio-deploiement -N ""
```

Sous Windows PowerShell, `""` vide est supprime et `~` n'est pas toujours compris :

```powershell
ssh-keygen -t ed25519 -C "deploiement-github-portfolio" -f "$env:USERPROFILE\.ssh\portfolio-deploiement" -N '""'
```

Deux fichiers apparaissent : `portfolio-deploiement` (privee) et
`portfolio-deploiement.pub` (publique).

### Declarer la cle publique sur Hostinger

Dans hPanel, **Advanced > SSH Access > SSH keys > Add SSH key**, collez le
contenu de `~/.ssh/portfolio-deploiement.pub`.

### Verifier

```bash
ssh -p 65002 -i ~/.ssh/portfolio-deploiement u528979203@<IP> "pwd"
```

La commande doit repondre sans demander de mot de passe.

---

## 2. Renseigner les secrets GitHub

Dans le depot, **Settings > Secrets and variables > Actions > New repository secret** :

| Secret | Contenu |
| --- | --- |
| `SSH_HOST` | L'adresse IP affichee par hPanel |
| `SSH_PORT` | `65002` |
| `SSH_USER` | `u528979203` |
| `DEPLOY_PATH` | `/home/u528979203/domains/elmahditamika.com/public_html/portfolio` |
| `SSH_PRIVATE_KEY` | Le contenu entier de `~/.ssh/portfolio-deploiement`, lignes `BEGIN` et `END` comprises |
| `PHP_BIN` | Facultatif. Le chemin du binaire PHP si `php` n'est pas en 8.2 |

Les anciens secrets `FTP_HOST`, `FTP_USERNAME` et `FTP_PASSWORD` ne servent plus
et peuvent etre supprimes.

Tant que ces secrets manquent, les tests tournent quand meme et la publication
est sautee, avec un recapitulatif dans l'onglet Actions.

---

## 3. Deployer

```bash
git push origin main
```

Suivez l'execution dans l'onglet **Actions**. On peut aussi relancer un
deploiement a la main : **Actions > Tests et deploiement > Run workflow**.

---

## Ce qui survit a un deploiement

`rsync --delete` efface du serveur ce qui a disparu du depot, sauf les chemins
listes dans [`exclusions.txt`](exclusions.txt). Sont donc preserves :

- `.env`, la configuration du serveur ;
- `storage/`, les journaux, les sessions et **les images televersees depuis l'admin** ;
- `public/storage`, le lien vers ces images.

Tout autre fichier ajoute a la main dans `public_html/portfolio` et absent du
depot sera supprime au prochain deploiement. Ajoutez-le a `exclusions.txt`
s'il doit rester.

---

## En cas de probleme

**La page est blanche ou affiche une erreur 500.**
Regardez `storage/logs/laravel.log`. Passez temporairement `APP_DEBUG=true`
dans `.env`, rechargez, puis remettez `false`.

**Les styles ne se chargent pas.**
Le dossier `public/build` n'est pas arrive. Verifiez l'etape « Compiler les
assets » dans Actions, et qu'aucun fichier `public/hot` ne traine sur le serveur.

**Le site reste en maintenance.**

```bash
cd <DEPLOY_PATH> && php artisan up
```

**Une modification de `.env` n'est pas prise en compte.**
La configuration est mise en cache a chaque deploiement :

```bash
cd <DEPLOY_PATH> && php artisan config:cache
```
