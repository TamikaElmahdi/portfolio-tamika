<template>
  <AdminLayout title="Catégories Blog" subtitle="Gérer les catégories des articles">
    <div class="flex justify-between mb-6">
      <Link href="/admin/blog" class="flex items-center gap-2 border border-gray-200 text-gray-700 font-medium px-4 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
        ← Articles
      </Link>
      <Link href="/admin/blog-categories/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Nouvelle catégorie
      </Link>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="categories.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">🏷️</span>
        <p class="font-medium">Aucune catégorie pour l'instant</p>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <div v-for="cat in categories" :key="cat.id" class="p-5 flex items-center justify-between gap-4 hover:bg-gray-50 transition-colors">
          <div class="flex items-center gap-4">
            <span class="w-4 h-4 rounded-full shrink-0" :style="{ backgroundColor: cat.color || '#3B82F6' }"></span>
            <div>
              <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-900">{{ cat.name_fr }}</h3>
                <span class="text-gray-400 text-sm">/ {{ cat.name_en }}</span>
              </div>
              <div class="flex items-center gap-3 mt-0.5 text-sm text-gray-400">
                <span class="font-mono">{{ cat.slug }}</span>
                <span>{{ cat.posts_count }} article{{ cat.posts_count !== 1 ? 's' : '' }}</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <Link :href="'/admin/blog-categories/' + cat.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deleteCategory(cat.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({ categories: Array })

const deleteCategory = (id) => {
  if (confirm('Supprimer cette catégorie ?')) router.delete('/admin/blog-categories/' + id)
}
</script>
