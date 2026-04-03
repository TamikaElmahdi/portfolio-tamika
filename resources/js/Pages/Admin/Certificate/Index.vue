<template>
  <AdminLayout title="Certifications" subtitle="Gérer les certifications">
    <div class="flex justify-end mb-6">
      <Link href="/admin/certificates/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Ajouter une certification
      </Link>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="certificates.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">🏆</span>
        <p class="font-medium">Aucune certification pour l'instant</p>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <div v-for="cert in certificates" :key="cert.id" class="p-5 flex items-start justify-between gap-4 hover:bg-gray-50 transition-colors">
          <div>
            <h3 class="font-bold text-gray-900">{{ cert.title_fr }}</h3>
            <p class="text-teal-600 font-medium text-sm">{{ cert.organization }}</p>
            <p class="text-gray-500 text-sm mt-1">📅 {{ cert.issued_date }}</p>
          </div>
          <div class="flex items-center gap-2">
            <Link :href="'/admin/certificates/' + cert.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deleteItem(cert.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineProps({ certificates: Array })
const deleteItem = (id) => { if (confirm('Supprimer cette certification ?')) router.delete('/admin/certificates/' + id) }
</script>
