<template>
  <AdminLayout title="Loisirs" subtitle="Gérer les loisirs et intérêts">
    <div class="flex justify-end mb-6">
      <Link href="/admin/hobbies/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Ajouter un loisir
      </Link>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="hobbies.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">🎯</span>
        <p class="font-medium">Aucun loisir pour l'instant</p>
      </div>
      <div v-else class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
        <div v-for="hobby in hobbies" :key="hobby.id" class="relative bg-gray-50 rounded-xl p-4 flex flex-col items-center gap-2 hover:bg-teal-50 transition-colors border border-gray-100">
          <span class="text-3xl">{{ hobby.icon || '🎯' }}</span>
          <span class="font-medium text-gray-800 text-sm text-center">{{ hobby.name_fr }}</span>
          <div class="flex gap-1 mt-1">
            <Link :href="'/admin/hobbies/' + hobby.id + '/edit'" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors text-sm">✏️</Link>
            <button @click="deleteItem(hobby.id)" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors text-sm">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineProps({ hobbies: Array })
const deleteItem = (id) => { if (confirm('Supprimer ce loisir ?')) router.delete('/admin/hobbies/' + id) }
</script>
