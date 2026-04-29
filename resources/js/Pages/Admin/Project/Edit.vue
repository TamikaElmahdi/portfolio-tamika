<template>
  <AdminLayout title="Modifier le projet" subtitle="Mettre à jour les informations">
    <div class="max-w-3xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (FR) *</label>
              <input v-model="form.title_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              <p v-if="form.errors.title_fr" class="mt-1 text-sm text-red-500">{{ form.errors.title_fr }}</p>
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (EN) *</label>
              <input v-model="form.title_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              <p v-if="form.errors.title_en" class="mt-1 text-sm text-red-500">{{ form.errors.title_en }}</p>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Description (FR) *</label>
              <textarea v-model="form.description_fr" rows="4" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none"></textarea>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Description (EN) *</label>
              <textarea v-model="form.description_en" rows="4" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none"></textarea>
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">URL Démo</label>
              <input v-model="form.demo_url" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">URL GitHub</label>
              <input v-model="form.github_url" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Technologies (séparées par des virgules)</label>
              <input v-model="technologiesInput" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div class="sm:col-span-2 flex items-center gap-3">
              <input v-model="form.featured" type="checkbox" id="featured" class="w-5 h-5 text-teal-600 border-gray-300 rounded">
              <label for="featured" class="font-medium text-gray-700">Projet mis en avant</label>
            </div>

            <!-- Images -->
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Images du projet</label>

              <!-- Existing images -->
              <div v-if="existingImages.length" class="mb-4">
                <p class="text-xs text-gray-500 mb-2">Images actuelles — cliquez ✕ pour supprimer</p>
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                  <div
                    v-for="img in existingImages"
                    :key="img.id"
                    class="relative group rounded-xl overflow-hidden border border-gray-200 aspect-video bg-gray-50"
                    :class="{ 'opacity-40 ring-2 ring-red-400': isMarkedForDeletion(img.id) }"
                  >
                    <img :src="'/storage/' + img.path" class="w-full h-full object-cover" />
                    <button
                      type="button"
                      @click="toggleDelete(img.id)"
                      class="absolute top-1 right-1 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity text-xs font-bold"
                      :class="isMarkedForDeletion(img.id) ? 'bg-gray-500 hover:bg-gray-600' : 'bg-red-500 hover:bg-red-600'"
                    >{{ isMarkedForDeletion(img.id) ? '↩' : '✕' }}</button>
                  </div>
                </div>
              </div>

              <!-- Drop zone for new images -->
              <div
                class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center cursor-pointer hover:border-teal-400 hover:bg-teal-50/30 transition-colors"
                @click="fileInput.click()"
                @dragover.prevent
                @drop.prevent="onDrop"
              >
                <div class="flex flex-col items-center gap-2 text-gray-400">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  <span class="text-sm font-medium">Ajouter des images</span>
                  <span class="text-xs">PNG, JPG, WebP — max 4 Mo par image</span>
                </div>
              </div>
              <input ref="fileInput" type="file" accept="image/*" multiple class="hidden" @change="onFileChange" />
              <p v-if="form.errors.images" class="mt-1 text-sm text-red-500">{{ form.errors.images }}</p>

              <!-- New image previews -->
              <div v-if="newPreviews.length" class="mt-4 grid grid-cols-3 sm:grid-cols-4 gap-3">
                <div
                  v-for="(preview, index) in newPreviews"
                  :key="index"
                  class="relative group rounded-xl overflow-hidden border border-teal-200 aspect-video bg-gray-50 ring-1 ring-teal-300"
                >
                  <img :src="preview" class="w-full h-full object-cover" />
                  <button
                    type="button"
                    @click="removeNew(index)"
                    class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity text-xs font-bold"
                  >✕</button>
                  <span class="absolute bottom-1 left-1 bg-teal-600/80 text-white text-xs px-1.5 py-0.5 rounded">Nouveau</span>
                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Mettre à jour
            </button>
            <Link href="/admin/projects" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
              <span>←</span> Annuler
            </Link>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, watch } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({ project: Object })

const form = useForm({
  _method: 'PUT',
  title_fr: props.project?.title_fr || '',
  title_en: props.project?.title_en || '',
  description_fr: props.project?.description_fr || '',
  description_en: props.project?.description_en || '',
  demo_url: props.project?.demo_url || '',
  github_url: props.project?.github_url || '',
  technologies: props.project?.technologies || [],
  featured: props.project?.featured || false,
  order: props.project?.order || 0,
  images: [],
  deleted_image_ids: [],
})

const technologiesInput = ref((props.project?.technologies || []).join(', '))
watch(technologiesInput, (val) => {
  form.technologies = val.split(',').map(t => t.trim()).filter(t => t)
})

// Existing images (from DB)
const existingImages = ref(props.project?.images || [])

function isMarkedForDeletion(id) {
  return form.deleted_image_ids.includes(id)
}

function toggleDelete(id) {
  const idx = form.deleted_image_ids.indexOf(id)
  if (idx === -1) {
    form.deleted_image_ids.push(id)
  } else {
    form.deleted_image_ids.splice(idx, 1)
  }
}

// New image uploads
const fileInput = ref(null)
const newPreviews = ref([])

function addFiles(files) {
  Array.from(files).forEach((file) => {
    form.images.push(file)
    newPreviews.value.push(URL.createObjectURL(file))
  })
}

function onFileChange(e) {
  addFiles(e.target.files)
  e.target.value = ''
}

function onDrop(e) {
  addFiles(e.dataTransfer.files)
}

function removeNew(index) {
  URL.revokeObjectURL(newPreviews.value[index])
  newPreviews.value.splice(index, 1)
  form.images.splice(index, 1)
}

const submit = () => form.post('/admin/projects/' + props.project.id, { forceFormData: true })
</script>
