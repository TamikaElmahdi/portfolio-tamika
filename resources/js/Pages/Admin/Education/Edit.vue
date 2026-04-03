<template>
  <AdminLayout title="Modifier la formation" subtitle="Mettre à jour les informations">
    <div class="max-w-3xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">École / Université *</label>
              <input v-model="form.school" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Diplôme (FR) *</label>
              <input v-model="form.degree_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Diplôme (EN) *</label>
              <input v-model="form.degree_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Spécialité (FR) *</label>
              <input v-model="form.field_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Spécialité (EN) *</label>
              <input v-model="form.field_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Année de début *</label>
              <input v-model.number="form.start_year" type="number" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Année de fin</label>
              <input v-model.number="form.end_year" type="number" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Description (FR)</label>
              <textarea v-model="form.description_fr" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none"></textarea>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Description (EN)</label>
              <textarea v-model="form.description_en" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none"></textarea>
            </div>
          </div>
          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Mettre à jour
            </button>
            <Link href="/admin/educations" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
              <span>←</span> Annuler
            </Link>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
const props = defineProps({ education: Object })
const form = useForm({
  school: props.education?.school || '', degree_fr: props.education?.degree_fr || '', degree_en: props.education?.degree_en || '',
  field_fr: props.education?.field_fr || '', field_en: props.education?.field_en || '',
  description_fr: props.education?.description_fr || '', description_en: props.education?.description_en || '',
  start_year: props.education?.start_year || new Date().getFullYear(), end_year: props.education?.end_year || null, order: props.education?.order || 0,
})
const submit = () => form.put('/admin/educations/' + props.education.id)
</script>
