<template>
  <AdminLayout title="Compétences" subtitle="Gérer les compétences techniques">
    <div class="flex justify-end mb-6">
      <Link href="/admin/skills/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Ajouter une compétence
      </Link>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="skills.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">⚡</span>
        <p class="font-medium">Aucune compétence pour l'instant</p>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <div v-for="skill in skills" :key="skill.id" class="p-5 flex items-center justify-between gap-4 hover:bg-gray-50 transition-colors">
          <div class="flex items-center gap-4 flex-1">
            <span class="text-2xl">{{ skill.icon || '⚡' }}</span>
            <div class="flex-1">
              <div class="flex items-center gap-3">
                <h3 class="font-bold text-gray-900">{{ skill.name }}</h3>
                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded-full capitalize">{{ skill.category }}</span>
              </div>
              <div class="flex items-center gap-2 mt-2">
                <div class="flex-1 max-w-48 h-2 bg-gray-100 rounded-full overflow-hidden">
                  <div class="h-full bg-teal-500 rounded-full" :style="{ width: skill.level + '%' }"></div>
                </div>
                <span class="text-sm font-bold text-teal-600">{{ skill.level }}%</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <Link :href="'/admin/skills/' + skill.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deleteItem(skill.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineProps({ skills: Array })
const deleteItem = (id) => { if (confirm('Supprimer cette compétence ?')) router.delete('/admin/skills/' + id) }
</script>
