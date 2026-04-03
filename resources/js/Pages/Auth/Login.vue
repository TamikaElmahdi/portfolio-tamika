<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 via-teal-900 to-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <!-- Logo -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-teal-600 rounded-2xl shadow-lg mb-4">
          <span class="text-3xl text-white font-bold">P</span>
        </div>
        <h1 class="text-2xl font-bold text-white">Admin Portfolio</h1>
        <p class="text-gray-400 text-sm mt-1">Connectez-vous à votre espace</p>
      </div>

      <!-- Card -->
      <div class="bg-white rounded-2xl shadow-2xl p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Connexion</h2>

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
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Mot de passe</label>
            <input
              v-model="form.password"
              type="password"
              required
              autocomplete="current-password"
              placeholder="••••••••"
              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
            />
          </div>
          <div class="flex items-center gap-2">
            <input v-model="form.remember" type="checkbox" id="remember" class="w-4 h-4 text-teal-600 border-gray-300 rounded">
            <label for="remember" class="text-sm text-gray-600">Se souvenir de moi</label>
          </div>
          <button
            type="submit"
            :disabled="processing"
            class="w-full flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold py-3 rounded-xl transition-all duration-200 hover:shadow-lg"
          >
            <span>{{ processing ? '⏳' : '🔐' }}</span>
            {{ processing ? 'Connexion...' : 'Se connecter' }}
          </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
          <a href="/" class="text-sm text-teal-600 hover:text-teal-700 font-medium flex items-center justify-center gap-1">
            <span>←</span> Retour au portfolio
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

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const processing = computed(() => form.processing)

const submit = () => {
  form.post('/login')
}
</script>
