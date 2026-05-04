<template>
  <AdminLayout title="Nouvel article" subtitle="Rédiger un nouvel article de blog">
    <div class="max-w-4xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-8">

          <!-- Titres -->
          <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Titres</h2>
            <div class="grid sm:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (FR) *</label>
                <input v-model="form.title_fr" @input="autoSlug" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
                <p v-if="form.errors.title_fr" class="mt-1 text-sm text-red-500">{{ form.errors.title_fr }}</p>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (EN) *</label>
                <input v-model="form.title_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
                <p v-if="form.errors.title_en" class="mt-1 text-sm text-red-500">{{ form.errors.title_en }}</p>
              </div>
            </div>
          </div>

          <!-- Slug -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Slug (URL)</label>
            <input v-model="form.slug" type="text" placeholder="auto-généré depuis le titre FR" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 font-mono text-sm" />
            <p class="mt-1 text-xs text-gray-400">Laissez vide pour générer automatiquement. Ex : mon-premier-article</p>
            <p v-if="form.errors.slug" class="mt-1 text-sm text-red-500">{{ form.errors.slug }}</p>
          </div>

          <!-- Extraits -->
          <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Extraits</h2>
            <div class="grid sm:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Extrait (FR)</label>
                <textarea v-model="form.excerpt_fr" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none" placeholder="Résumé court affiché dans la liste..."></textarea>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Extrait (EN)</label>
                <textarea v-model="form.excerpt_en" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none" placeholder="Short summary shown in the list..."></textarea>
              </div>
            </div>
          </div>

          <!-- Contenu -->
          <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Contenu</h2>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Contenu (FR)</label>
                <textarea v-model="form.content_fr" rows="14" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-y font-mono text-sm" placeholder="Contenu HTML ou Markdown..."></textarea>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Contenu (EN)</label>
                <textarea v-model="form.content_en" rows="14" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-y font-mono text-sm" placeholder="HTML or Markdown content..."></textarea>
              </div>
            </div>
          </div>

          <!-- Images -->
          <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Images</h2>
            <div class="grid sm:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Image de couverture</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50/30 transition-colors" @click="coverInput.click()">
                  <img v-if="coverPreview" :src="coverPreview" class="w-full h-32 object-cover rounded-lg mb-2" />
                  <div v-else class="text-gray-400 text-sm">📷 Cliquez pour choisir</div>
                </div>
                <input ref="coverInput" type="file" accept="image/*" class="hidden" @change="onCoverChange" />
                <p v-if="form.errors.cover_image" class="mt-1 text-sm text-red-500">{{ form.errors.cover_image }}</p>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Image Open Graph (réseaux sociaux)</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50/30 transition-colors" @click="ogInput.click()">
                  <img v-if="ogPreview" :src="ogPreview" class="w-full h-32 object-cover rounded-lg mb-2" />
                  <div v-else class="text-gray-400 text-sm">🌐 Image pour les partages sociaux</div>
                </div>
                <input ref="ogInput" type="file" accept="image/*" class="hidden" @change="onOgChange" />
                <p v-if="form.errors.og_image" class="mt-1 text-sm text-red-500">{{ form.errors.og_image }}</p>
              </div>
            </div>
          </div>

          <!-- Catégories & Tags -->
          <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Classification</h2>
            <div class="grid sm:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Catégories</label>
                <div class="space-y-2">
                  <label
                    v-for="cat in categories"
                    :key="cat.id"
                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-teal-200 cursor-pointer transition-colors"
                    :class="form.category_ids.includes(cat.id) ? 'border-teal-300 bg-teal-50/50' : ''"
                  >
                    <input type="checkbox" :value="cat.id" v-model="form.category_ids" class="w-4 h-4 text-teal-600 border-gray-300 rounded" />
                    <span class="w-3 h-3 rounded-full shrink-0" :style="{ backgroundColor: cat.color || '#3B82F6' }"></span>
                    <span class="text-sm font-medium text-gray-700">{{ cat.name_fr }}</span>
                  </label>
                  <p v-if="categories.length === 0" class="text-sm text-gray-400 p-3">
                    <Link href="/admin/blog-categories/create" class="text-teal-600 hover:underline">Créer des catégories</Link> d'abord
                  </p>
                </div>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tags (séparés par des virgules)</label>
                <input v-model="form.tags" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="laravel, vue.js, tailwind" />
                <div v-if="tags.length > 0" class="flex flex-wrap gap-1 mt-2">
                  <button
                    v-for="tag in tags"
                    :key="tag.id"
                    type="button"
                    @click="appendTag(tag.name)"
                    class="px-2 py-0.5 bg-gray-100 text-gray-600 hover:bg-teal-100 hover:text-teal-700 rounded text-xs transition-colors"
                  >#{{ tag.name }}</button>
                </div>
              </div>
            </div>
          </div>

          <!-- SEO & Publication -->
          <div>
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">SEO & Publication</h2>
            <div class="grid sm:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Meta title (FR)</label>
                <input v-model="form.meta_title_fr" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Meta title (EN)</label>
                <input v-model="form.meta_title_en" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Meta description (FR)</label>
                <textarea v-model="form.meta_description_fr" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none" maxlength="500"></textarea>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Meta description (EN)</label>
                <textarea v-model="form.meta_description_en" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none" maxlength="500"></textarea>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Temps de lecture (min) — laisser vide pour calcul auto</label>
                <input v-model.number="form.reading_time" type="number" min="1" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ordre d'affichage</label>
                <input v-model.number="form.order" type="number" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Date de publication</label>
                <input v-model="form.published_at" type="datetime-local" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              </div>
              <div class="flex items-center gap-3 self-end pb-3">
                <input v-model="form.is_published" type="checkbox" id="is_published" class="w-5 h-5 text-teal-600 border-gray-300 rounded" />
                <label for="is_published" class="font-medium text-gray-700">Publier l'article</label>
              </div>
            </div>
          </div>

          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Enregistrer
            </button>
            <Link href="/admin/blog" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
              <span>←</span> Annuler
            </Link>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  categories: Array,
  tags: Array,
})

const form = useForm({
  title_fr: '', title_en: '', slug: '',
  excerpt_fr: '', excerpt_en: '',
  content_fr: '', content_en: '',
  cover_image: null, og_image: null,
  reading_time: null,
  is_published: false, published_at: '',
  meta_title_fr: '', meta_title_en: '',
  meta_description_fr: '', meta_description_en: '',
  order: 0, category_ids: [], tags: '',
})

const coverInput = ref(null)
const ogInput = ref(null)
const coverPreview = ref(null)
const ogPreview = ref(null)

const slugify = (str) => str.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '')

const autoSlug = () => {
  if (!form.slug) form.slug = slugify(form.title_fr)
}

const onCoverChange = (e) => {
  const file = e.target.files[0]
  if (!file) return
  form.cover_image = file
  coverPreview.value = URL.createObjectURL(file)
}

const onOgChange = (e) => {
  const file = e.target.files[0]
  if (!file) return
  form.og_image = file
  ogPreview.value = URL.createObjectURL(file)
}

const appendTag = (name) => {
  const current = form.tags ? form.tags.split(',').map(t => t.trim()).filter(Boolean) : []
  if (!current.includes(name)) {
    form.tags = [...current, name].join(', ')
  }
}

const submit = () => form.post('/admin/blog', { forceFormData: true })
</script>
