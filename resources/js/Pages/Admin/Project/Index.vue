<template>
  <AdminLayout title="Projets" subtitle="Gérer les projets du portfolio">
    <div class="flex justify-end mb-6">
      <Link href="/admin/projects/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Ajouter un projet
      </Link>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="projects.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">🚀</span>
        <p class="font-medium">Aucun projet pour l'instant</p>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <div v-for="project in projects" :key="project.id" class="p-5 flex items-start justify-between gap-4 hover:bg-gray-50 transition-colors">
          <div class="flex-1">
            <div class="flex items-center gap-2">
              <h3 class="font-bold text-gray-900">{{ project.title_fr }}</h3>
              <span v-if="project.featured" class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">⭐ Featured</span>
            </div>
            <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ project.description_fr?.substring(0, 100) }}...</p>
            <div class="flex flex-wrap gap-1 mt-2">
              <span v-for="tech in (project.technologies || []).slice(0, 5)" :key="tech" class="px-2 py-0.5 bg-teal-50 text-teal-700 text-xs rounded-full">{{ tech }}</span>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <Link :href="'/admin/projects/' + project.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deleteItem(project.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineProps({ projects: Array })
const deleteItem = (id) => { if (confirm('Supprimer ce projet ?')) router.delete('/admin/projects/' + id) }
</script>
