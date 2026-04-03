<template>
  <AdminLayout title="Modifier le loisir" subtitle="Mettre à jour les informations">
    <div class="max-w-2xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nom (FR) *</label>
              <input v-model="form.name_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nom (EN) *</label>
              <input v-model="form.name_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Icône (emoji)</label>
              <input v-model="form.icon" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Couleur</label>
              <div class="flex gap-2">
                <input v-model="form.color" type="color" class="w-12 h-12 rounded-lg border border-gray-200 cursor-pointer" />
                <input v-model="form.color" type="text" class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              </div>
            </div>
          </div>
          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Mettre à jour
            </button>
            <Link href="/admin/hobbies" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
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
const props = defineProps({ hobby: Object })
const form = useForm({ name_fr: props.hobby?.name_fr || '', name_en: props.hobby?.name_en || '', icon: props.hobby?.icon || '', color: props.hobby?.color || '#14b8a6', order: props.hobby?.order || 0 })
const submit = () => form.put('/admin/hobbies/' + props.hobby.id)
</script>
