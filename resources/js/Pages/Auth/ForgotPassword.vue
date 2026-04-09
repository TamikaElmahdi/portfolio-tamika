<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 via-teal-900 to-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <!-- Logo -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-teal-600 rounded-2xl shadow-lg mb-4">
          <span class="text-3xl text-white font-bold">P</span>
        </div>
        <h1 class="text-2xl font-bold text-white">Admin Portfolio</h1>
        <p class="text-gray-400 text-sm mt-1">Réinitialisation du mot de passe</p>
      </div>

      <!-- Card -->
      <div class="bg-white rounded-2xl shadow-2xl p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-2">Mot de passe oublié ?</h2>
        <p class="text-sm text-gray-500 mb-6">
          Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
        </p>

        <div v-if="status" class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
          <span>✅</span> {{ status }}
        </div>

        <div v-if="errors.email" class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm flex items-center gap-2">
          <span>⚠️</span> {{ errors.email }}
        </div>

        <form @submit.prevent="submit" class="space-y-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Adresse email</label>
            <input
              v-model="form.email"
              type="email"
              required
              autofocus
              autocomplete="username"
              placeholder="admin@portfolio.com"
              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
            />
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="w-full flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold py-3 rounded-xl transition-all duration-200 hover:shadow-lg"
          >
            <span>{{ form.processing ? '⏳' : '📧' }}</span>
            {{ form.processing ? 'Envoi en cours...' : 'Envoyer le lien' }}
          </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
          <a href="/login" class="text-sm text-teal-600 hover:text-teal-700 font-medium flex items-center justify-center gap-1">
            <span>←</span> Retour à la connexion
          </a>
        </div>
      </div>

      <p class="text-center text-xs text-gray-500 mt-4">Portfolio Admin • Version 1.0</p>
    </div>
  </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const errors = computed(() => page.props.errors || {})
const status = computed(() => page.props.status || null)

const form = useForm({
  email: '',
})

const submit = () => {
  form.post('/forgot-password')
}
</script>
