<template>
  <AdminLayout title="Nouvelle expérience" subtitle="Ajouter une expérience professionnelle">
    <div class="max-w-3xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Entreprise *</label>
              <input v-model="form.company" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Poste (FR) *</label>
              <input v-model="form.position_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Poste (EN) *</label>
              <input v-model="form.position_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
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
              <label class="block text-sm font-semibold text-gray-700 mb-2">Date de début *</label>
              <input v-model="form.start_date" type="date" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Date de fin</label>
              <input v-model="form.end_date" type="date" :disabled="form.is_current" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 disabled:opacity-50" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
              <input v-model="form.location" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Type de contrat</label>
              <select v-model="form.contract_type" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">Sélectionner</option>
                <option>CDI</option>
                <option>CDD</option>
                <option>Freelance</option>
                <option>Stage</option>
                <option>Alternance</option>
              </select>
            </div>
            <div class="sm:col-span-2 flex items-center gap-3">
              <input v-model="form.is_current" type="checkbox" id="is_current" class="w-5 h-5 text-teal-600 border-gray-300 rounded">
              <label for="is_current" class="font-medium text-gray-700">Poste actuel</label>
            </div>
          </div>
          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Enregistrer
            </button>
            <Link href="/admin/experiences" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
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

const form = useForm({
  company: '', position_fr: '', position_en: '', description_fr: '', description_en: '',
  start_date: '', end_date: '', is_current: false, location: '', contract_type: '', order: 0,
})

const submit = () => form.post('/admin/experiences')
</script>
