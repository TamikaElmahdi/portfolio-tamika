<template>
  <AdminLayout title="Blog" subtitle="Gérer les articles du blog">
    <div class="flex justify-end mb-6 gap-3">
      <Link href="/admin/blog-categories" class="flex items-center gap-2 border border-gray-200 text-gray-700 font-medium px-4 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
        🏷️ Catégories
      </Link>
      <Link href="/admin/blog/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Nouvel article
      </Link>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="posts.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">✍️</span>
        <p class="font-medium">Aucun article pour l'instant</p>
        <Link href="/admin/blog/create" class="mt-4 inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium">
          Créer le premier article →
        </Link>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <div v-for="post in posts" :key="post.id" class="p-5 flex items-start justify-between gap-4 hover:bg-gray-50 transition-colors">
          <div class="flex items-start gap-4 flex-1">
            <div v-if="post.cover_image" class="w-20 h-14 rounded-lg overflow-hidden shrink-0 bg-gray-100">
              <img :src="'/storage/' + post.cover_image" :alt="post.title_fr" class="w-full h-full object-cover" />
            </div>
            <div class="flex-1">
              <div class="flex items-center gap-2 flex-wrap">
                <h3 class="font-bold text-gray-900">{{ post.title_fr }}</h3>
                <span v-if="post.is_published" class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded-full">✅ Publié</span>
                <span v-else class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">⏳ Brouillon</span>
              </div>
              <div class="flex flex-wrap gap-1 mt-1">
                <span
                  v-for="cat in post.categories"
                  :key="cat.id"
                  class="px-2 py-0.5 text-xs rounded-full font-medium"
                  :style="{ backgroundColor: (cat.color || '#3B82F6') + '20', color: cat.color || '#3B82F6' }"
                >{{ cat.name_fr }}</span>
              </div>
              <div class="flex items-center gap-4 mt-1 text-xs text-gray-400">
                <span v-if="post.published_at">{{ formatDate(post.published_at) }}</span>
                <span>{{ post.reading_time }} min de lecture</span>
                <span>👁 {{ post.views }} vues</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2 shrink-0">
            <a :href="'/blog/' + post.slug" target="_blank" class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors" title="Voir l'article">🔗</a>
            <Link :href="'/admin/blog/' + post.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deletePost(post.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({ posts: Array })

const deletePost = (id) => {
  if (confirm('Supprimer cet article ?')) router.delete('/admin/blog/' + id)
}

const formatDate = (dateStr) => {
  if (!dateStr) return ''
  return new Date(dateStr).toLocaleDateString('fr-FR', { year: 'numeric', month: 'short', day: 'numeric' })
}
</script>
