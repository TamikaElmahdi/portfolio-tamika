<template>
  <AdminLayout title="Témoignages" subtitle="Gérer les recommandations et témoignages">
    <div class="flex justify-end mb-6">
      <Link href="/admin/testimonials/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Ajouter un témoignage
      </Link>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="testimonials.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">💬</span>
        <p class="font-medium">Aucun témoignage pour l'instant</p>
      </div>
      <div v-else class="divide-y divide-gray-50">
        <div v-for="item in testimonials" :key="item.id" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors">
          <!-- Avatar -->
          <div class="w-12 h-12 rounded-full overflow-hidden bg-teal-100 flex items-center justify-center shrink-0">
            <img v-if="item.author_avatar" :src="'/storage/' + item.author_avatar" :alt="item.author_name" class="w-full h-full object-cover" />
            <span v-else class="text-xl">👤</span>
          </div>
          <!-- Info -->
          <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2">
              <p class="font-semibold text-gray-900 truncate">{{ item.author_name }}</p>
              <span v-if="item.featured" class="text-xs bg-yellow-100 text-yellow-700 font-semibold px-2 py-0.5 rounded-full">⭐ Featured</span>
            </div>
            <p class="text-sm text-gray-500 truncate">{{ item.author_position }}{{ item.author_company ? ' — ' + item.author_company : '' }}</p>
            <p class="text-sm text-gray-600 mt-1 line-clamp-1">{{ item.content_fr }}</p>
          </div>
          <!-- Rating -->
          <div class="text-yellow-400 text-sm shrink-0">
            {{ '★'.repeat(item.rating) }}{{ '☆'.repeat(5 - item.rating) }}
          </div>
          <!-- Actions -->
          <div class="flex gap-1 shrink-0">
            <Link :href="'/admin/testimonials/' + item.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deleteItem(item.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineProps({ testimonials: Array })
const deleteItem = (id) => { if (confirm('Supprimer ce témoignage ?')) router.delete('/admin/testimonials/' + id) }
</script>
