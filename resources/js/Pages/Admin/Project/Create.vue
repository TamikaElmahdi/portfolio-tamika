<template>
  <AdminLayout title="Nouveau projet" subtitle="Ajouter un projet au portfolio">
    <div class="max-w-3xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (FR) *</label>
              <input v-model="form.title_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (EN) *</label>
              <input v-model="form.title_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
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
              <input v-model="form.demo_url" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="https://..." />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">URL GitHub</label>
              <input v-model="form.github_url" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="https://github.com/..." />
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Technologies (séparées par des virgules)</label>
              <input v-model="technologiesInput" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Vue.js, Laravel, Tailwind CSS" />
            </div>
            <div class="sm:col-span-2 flex items-center gap-3">
              <input v-model="form.featured" type="checkbox" id="featured" class="w-5 h-5 text-teal-600 border-gray-300 rounded">
              <label for="featured" class="font-medium text-gray-700">Projet mis en avant (featured)</label>
            </div>
          </div>
          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Enregistrer
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

const form = useForm({ title_fr: '', title_en: '', description_fr: '', description_en: '', demo_url: '', github_url: '', technologies: [], featured: false, order: 0 })
const technologiesInput = ref('')
watch(technologiesInput, (val) => {
  form.technologies = val.split(',').map(t => t.trim()).filter(t => t)
})
const submit = () => form.post('/admin/projects')
</script>
