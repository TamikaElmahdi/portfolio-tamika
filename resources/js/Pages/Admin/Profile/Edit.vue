<template>
  <AdminLayout title="Modifier le profil" subtitle="Informations personnelles">
    <div class="max-w-3xl">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-6">

          <!-- Avatar upload -->
          <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Photo de profil</label>
            <div class="flex items-center gap-6">
              <!-- Preview -->
              <div class="relative w-28 h-28 rounded-full overflow-hidden border-4 border-teal-100 shadow-md shrink-0 bg-linear-to-br from-teal-400 to-teal-700">
                <img
                  v-if="avatarPreview"
                  :src="avatarPreview"
                  alt="Aperçu"
                  class="w-full h-full object-cover"
                />
                <img
                  v-else-if="props.profile?.avatar"
                  :src="'/storage/' + props.profile.avatar"
                  alt="Photo actuelle"
                  class="w-full h-full object-cover"
                />
                <div v-else class="w-full h-full flex items-center justify-center">
                  <span class="text-5xl">👨‍💻</span>
                </div>
                <!-- Overlay on hover -->
                <label
                  for="avatar-input"
                  class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity cursor-pointer"
                >
                  <span class="text-white text-2xl">📷</span>
                </label>
              </div>

              <!-- Upload zone -->
              <div class="flex-1">
                <label
                  for="avatar-input"
                  class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-teal-300 rounded-xl cursor-pointer hover:border-teal-500 hover:bg-teal-50 transition-all"
                >
                  <span class="text-2xl mb-1">📤</span>
                  <span class="text-sm font-medium text-teal-700">
                    {{ avatarPreview ? 'Changer la photo' : 'Choisir une photo' }}
                  </span>
                  <span class="text-xs text-gray-400 mt-0.5">JPG, PNG, WEBP — max 2MB</span>
                </label>
                <input
                  id="avatar-input"
                  type="file"
                  accept="image/*"
                  class="hidden"
                  @change="onAvatarChange"
                />
                <p v-if="form.errors.avatar" class="text-red-500 text-sm mt-1">{{ form.errors.avatar }}</p>
                <button
                  v-if="avatarPreview || props.profile?.avatar"
                  type="button"
                  @click="removeAvatar"
                  class="mt-2 text-xs text-red-500 hover:text-red-700 flex items-center gap-1"
                >
                  <span>✕</span> Supprimer la photo
                </button>
              </div>
            </div>
          </div>

          <div class="border-t border-gray-100 pt-6 grid sm:grid-cols-2 gap-6">
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nom complet *</label>
              <input v-model="form.name" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
              <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
            </div>

            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (FR) *</label>
              <input v-model="form.title_fr" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Titre (EN) *</label>
              <input v-model="form.title_en" type="text" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>

            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Bio (FR) *</label>
              <textarea v-model="form.bio_fr" rows="4" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none"></textarea>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Bio (EN) *</label>
              <textarea v-model="form.bio_en" rows="4" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 resize-none"></textarea>
            </div>

            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
              <input v-model="form.email" type="email" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
              <input v-model="form.phone" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">GitHub URL</label>
              <input v-model="form.github" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">LinkedIn URL</label>
              <input v-model="form.linkedin" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Site web</label>
              <input v-model="form.website" type="url" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
              <input v-model="form.location" type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Années d'expérience</label>
              <input v-model.number="form.years_experience" type="number" min="0" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500" />
            </div>

            <div class="flex items-center gap-3 pt-2">
              <input v-model="form.available" type="checkbox" id="available" class="w-5 h-5 text-teal-600 border-gray-300 rounded">
              <label for="available" class="font-medium text-gray-700">Disponible pour des missions</label>
            </div>
          </div>

          <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" :disabled="form.processing" class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
              <span>{{ form.processing ? '⏳' : '💾' }}</span>
              {{ form.processing ? 'Enregistrement...' : 'Enregistrer' }}
            </button>
            <Link href="/admin" class="flex items-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
              <span>←</span> Retour
            </Link>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({ profile: Object })

const avatarPreview = ref(null)

const form = useForm({
  _method: 'PUT',
  name: props.profile?.name || '',
  title_fr: props.profile?.title_fr || '',
  title_en: props.profile?.title_en || '',
  bio_fr: props.profile?.bio_fr || '',
  bio_en: props.profile?.bio_en || '',
  email: props.profile?.email || '',
  phone: props.profile?.phone || '',
  github: props.profile?.github || '',
  linkedin: props.profile?.linkedin || '',
  website: props.profile?.website || '',
  location: props.profile?.location || '',
  available: props.profile?.available ?? true,
  years_experience: props.profile?.years_experience || 0,
  avatar: null,
})

const onAvatarChange = (e) => {
  const file = e.target.files[0]
  if (!file) return
  form.avatar = file
  const reader = new FileReader()
  reader.onload = (ev) => { avatarPreview.value = ev.target.result }
  reader.readAsDataURL(file)
}

const removeAvatar = () => {
  avatarPreview.value = null
  form.avatar = null
  const input = document.getElementById('avatar-input')
  if (input) input.value = ''
}

const submit = () => {
  form.post('/admin/profile')
}
</script>
