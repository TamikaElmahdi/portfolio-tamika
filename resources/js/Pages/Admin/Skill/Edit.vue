<template>
  <AdminLayout title="Modifier la compétence" subtitle="Mettre à jour les informations">
    <div class="max-w-2xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
              <input v-model="form.name" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Catégorie *</label>
              <select v-model="form.category" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="frontend">Frontend</option>
                <option value="backend">Backend</option>
                <option value="tools">Outils</option>
                <option value="other">Autre</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Icône (emoji)</label>
              <input v-model="form.icon" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Niveau: {{ form.level }}%</label>
              <input v-model.number="form.level" type="range" min="1" max="100" class="w-full accent-teal-600" />
            </div>
          </div>
          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Mettre à jour
            </button>
            <Link href="/admin/skills" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
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
const props = defineProps({ skill: Object })
const form = useForm({ name: props.skill?.name || '', category: props.skill?.category || 'frontend', icon: props.skill?.icon || '', level: props.skill?.level || 75, order: props.skill?.order || 0 })
const submit = () => form.put('/admin/skills/' + props.skill.id)
</script>
