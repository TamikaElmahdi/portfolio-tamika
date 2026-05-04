<template>
  <AdminLayout :title="'Modifier : ' + category.name_fr" subtitle="Modifier une catégorie de blog">
    <div class="max-w-lg">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nom (FR) *</label>
              <input v-model="form.name_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              <p v-if="form.errors.name_fr" class="mt-1 text-sm text-red-500">{{ form.errors.name_fr }}</p>
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nom (EN) *</label>
              <input v-model="form.name_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              <p v-if="form.errors.name_en" class="mt-1 text-sm text-red-500">{{ form.errors.name_en }}</p>
            </div>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Slug</label>
            <input v-model="form.slug" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 font-mono text-sm" />
            <p v-if="form.errors.slug" class="mt-1 text-sm text-red-500">{{ form.errors.slug }}</p>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Couleur</label>
            <div class="flex items-center gap-3">
              <input v-model="form.color" type="color" class="w-12 h-12 p-1 border border-gray-200 rounded-xl cursor-pointer" />
              <input v-model="form.color" type="text" class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 font-mono text-sm" />
            </div>
            <div class="flex gap-2 mt-3">
              <button v-for="color in presetColors" :key="color" type="button" @click="form.color = color"
                class="w-8 h-8 rounded-full border-2 transition-transform hover:scale-110"
                :style="{ backgroundColor: color }"
                :class="form.color === color ? 'border-gray-900 scale-110' : 'border-transparent'"
              ></button>
            </div>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Ordre d'affichage</label>
            <input v-model.number="form.order" type="number" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
          </div>

          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Mettre à jour
            </button>
            <Link href="/admin/blog-categories" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
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

const props = defineProps({ category: Object })

const presetColors = ['#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EF4444', '#EC4899', '#06B6D4', '#6B7280']

const form = useForm({
  name_fr: props.category.name_fr || '',
  name_en: props.category.name_en || '',
  slug: props.category.slug || '',
  color: props.category.color || '#3B82F6',
  order: props.category.order || 0,
  _method: 'PUT',
})

const submit = () => form.post('/admin/blog-categories/' + props.category.id)
</script>
