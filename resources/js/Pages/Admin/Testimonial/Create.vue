<template>
  <AdminLayout title="Nouveau témoignage" subtitle="Ajouter une recommandation">
    <div class="max-w-2xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nom de l'auteur *</label>
              <input v-model="form.author_name" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Ex: Jean Dupont" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Poste</label>
              <input v-model="form.author_position" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Ex: CTO" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Entreprise</label>
              <input v-model="form.author_company" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Ex: Acme Corp" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Relation</label>
              <select v-model="form.relation" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">— Sélectionner —</option>
                <option value="colleague">Collègue</option>
                <option value="client">Client</option>
                <option value="supervisor">Superviseur</option>
                <option value="mentor">Mentor</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Note (1-5)</label>
              <select v-model="form.rating" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option :value="5">★★★★★ (5)</option>
                <option :value="4">★★★★☆ (4)</option>
                <option :value="3">★★★☆☆ (3)</option>
                <option :value="2">★★☆☆☆ (2)</option>
                <option :value="1">★☆☆☆☆ (1)</option>
              </select>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Témoignage (FR) *</label>
              <textarea v-model="form.content_fr" rows="4" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none" placeholder="Témoignage en français..."></textarea>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Témoignage (EN)</label>
              <textarea v-model="form.content_en" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none" placeholder="Testimonial in English..."></textarea>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Photo (optionnel)</label>
              <input type="file" accept="image/*" @change="e => form.author_avatar = e.target.files[0]" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Profil LinkedIn</label>
              <input v-model="form.linkedin_url" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="https://linkedin.com/in/..." />
            </div>
            <div class="flex items-center gap-3">
              <input v-model="form.featured" type="checkbox" id="featured" class="w-4 h-4 text-teal-600 rounded" />
              <label for="featured" class="text-sm font-semibold text-gray-700">Mettre en avant (Featured)</label>
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Ordre d'affichage</label>
              <input v-model="form.order" type="number" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
          </div>
          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>💾</span> Enregistrer
            </button>
            <Link href="/admin/testimonials" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
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

const form = useForm({
  author_name: '',
  author_position: '',
  author_company: '',
  author_avatar: null,
  content_fr: '',
  content_en: '',
  rating: 5,
  relation: '',
  linkedin_url: '',
  featured: false,
  order: 0,
})

const submit = () => form.post('/admin/testimonials', { forceFormData: true })
</script>
