<template>
  <AdminLayout title="Expériences" subtitle="Gérer les expériences professionnelles">
    <div class="flex justify-end mb-6">
      <Link href="/admin/experiences/create" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <span>+</span> Ajouter une expérience
      </Link>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="experiences.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">💼</span>
        <p class="font-medium">Aucune expérience pour l'instant</p>
        <Link href="/admin/experiences/create" class="mt-4 inline-block text-teal-600 hover:text-teal-700 font-medium">Ajouter la première →</Link>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <div v-for="exp in experiences" :key="exp.id" class="p-5 flex items-start justify-between gap-4 hover:bg-gray-50 transition-colors">
          <div class="flex-1">
            <h3 class="font-bold text-gray-900">{{ exp.position_fr }}</h3>
            <p class="text-teal-600 font-medium text-sm">{{ exp.company }}</p>
            <div class="flex items-center gap-3 mt-1 text-sm text-gray-500">
              <span>📅 {{ exp.start_date }} — {{ exp.is_current ? 'Présent' : exp.end_date }}</span>
              <span v-if="exp.location">📍 {{ exp.location }}</span>
              <span v-if="exp.contract_type" class="px-2 py-0.5 bg-gray-100 rounded-full text-xs">{{ exp.contract_type }}</span>
              <span v-if="exp.is_current" class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Actuel</span>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <Link :href="'/admin/experiences/' + exp.id + '/edit'" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">✏️</Link>
            <button @click="deleteItem(exp.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">🗑️</button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({ experiences: Array })

const deleteItem = (id) => {
  if (confirm('Supprimer cette expérience ?')) {
    router.delete('/admin/experiences/' + id)
  }
}
</script>
