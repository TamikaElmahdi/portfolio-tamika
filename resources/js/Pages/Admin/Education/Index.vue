<template>
  <AdminLayout title="Formations" subtitle="Gérer les formations académiques">
    <div class="flex justify-end mb-6">
      <Link href="/admin/educations/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Ajouter une formation
      </Link>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="educations.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">🎓</span>
        <p class="font-medium">Aucune formation pour l'instant</p>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <div v-for="edu in educations" :key="edu.id" class="p-5 flex items-start justify-between gap-4 hover:bg-gray-50 transition-colors">
          <div>
            <h3 class="font-bold text-gray-900">{{ edu.degree_fr }}</h3>
            <p class="text-teal-600 font-medium text-sm">{{ edu.field_fr }}</p>
            <p class="text-gray-500 text-sm">🎓 {{ edu.school }} • {{ edu.start_year }} — {{ edu.end_year || 'Présent' }}</p>
          </div>
          <div class="flex items-center gap-2">
            <Link :href="'/admin/educations/' + edu.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deleteItem(edu.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineProps({ educations: Array })
const deleteItem = (id) => { if (confirm('Supprimer cette formation ?')) router.delete('/admin/educations/' + id) }
</script>
