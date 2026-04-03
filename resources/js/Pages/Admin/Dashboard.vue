<template>
  <AdminLayout title="Tableau de bord" subtitle="Vue d'ensemble de votre portfolio">
    <!-- Stats grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
      <div
        v-for="stat in stats"
        :key="stat.label"
        class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-all"
      >
        <div class="flex items-center justify-between mb-3">
          <span class="text-3xl">{{ stat.icon }}</span>
          <span
            v-if="stat.badge"
            class="px-2 py-0.5 bg-red-100 text-red-600 text-xs font-bold rounded-full"
          >
            {{ stat.badge }} non lus
          </span>
        </div>
        <div class="text-2xl font-extrabold text-gray-900">{{ stat.value }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ stat.label }}</div>
      </div>
    </div>

    <!-- Quick actions -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
      <h2 class="text-lg font-bold text-gray-900 mb-4">Actions rapides</h2>
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
        <Link
          v-for="action in quickActions"
          :key="action.href"
          :href="action.href"
          class="flex flex-col items-center gap-2 p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-teal-400 hover:bg-teal-50 transition-all duration-200 text-center group"
        >
          <span class="text-3xl">{{ action.icon }}</span>
          <span class="text-sm font-medium text-gray-600 group-hover:text-teal-700">{{ action.label }}</span>
        </Link>
      </div>
    </div>

    <!-- Recent info -->
    <div class="grid lg:grid-cols-2 gap-6">
      <!-- Quick links -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Navigation rapide</h2>
        <div class="space-y-2">
          <Link
            v-for="link in navLinks"
            :key="link.href"
            :href="link.href"
            class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors group"
          >
            <div class="flex items-center gap-3">
              <span class="text-xl">{{ link.icon }}</span>
              <span class="font-medium text-gray-700 group-hover:text-teal-600">{{ link.label }}</span>
            </div>
            <span class="text-gray-400 group-hover:text-teal-600">→</span>
          </Link>
        </div>
      </div>

      <!-- Portfolio link -->
      <div class="bg-gradient-to-br from-teal-600 to-teal-800 rounded-2xl p-6 text-white">
        <h2 class="text-lg font-bold mb-2">🚀 Votre Portfolio</h2>
        <p class="text-teal-100 text-sm mb-6">Visualisez votre portfolio public et vérifiez son rendu.</p>
        <Link
          href="/"
          target="_blank"
          class="inline-flex items-center gap-2 bg-white text-teal-700 font-semibold px-4 py-2.5 rounded-xl hover:bg-teal-50 transition-colors"
        >
          <span>🔗</span> Voir le portfolio
        </Link>

        <div class="mt-6 pt-6 border-t border-teal-500">
          <p class="text-teal-200 text-xs">Connecté en tant qu'administrateur</p>
          <p class="text-white font-medium">{{ user?.name }}</p>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  counts: Object,
})

const page = usePage()
const user = computed(() => page.props.auth?.user)

const stats = computed(() => [
  { label: 'Expériences', value: props.counts?.experiences || 0, icon: '💼' },
  { label: 'Formations', value: props.counts?.educations || 0, icon: '🎓' },
  { label: 'Compétences', value: props.counts?.skills || 0, icon: '⚡' },
  { label: 'Certifications', value: props.counts?.certificates || 0, icon: '🏆' },
  { label: 'Projets', value: props.counts?.projects || 0, icon: '🚀' },
  { label: 'Loisirs', value: props.counts?.hobbies || 0, icon: '🎯' },
  { label: 'Messages', value: props.counts?.messages || 0, icon: '✉️', badge: props.counts?.unread_messages > 0 ? props.counts.unread_messages : null },
])

const quickActions = [
  { href: '/admin/experiences/create', icon: '💼', label: 'Ajouter expérience' },
  { href: '/admin/projects/create', icon: '🚀', label: 'Ajouter projet' },
  { href: '/admin/skills/create', icon: '⚡', label: 'Ajouter compétence' },
  { href: '/admin/certificates/create', icon: '🏆', label: 'Ajouter certificat' },
  { href: '/admin/educations/create', icon: '🎓', label: 'Ajouter formation' },
  { href: '/admin/hobbies/create', icon: '🎯', label: 'Ajouter loisir' },
]

const navLinks = [
  { href: '/admin/profile', icon: '👤', label: 'Modifier le profil' },
  { href: '/admin/messages', icon: '✉️', label: 'Voir les messages' },
  { href: '/admin/experiences', icon: '💼', label: 'Gérer les expériences' },
  { href: '/admin/projects', icon: '🚀', label: 'Gérer les projets' },
  { href: '/admin/skills', icon: '⚡', label: 'Gérer les compétences' },
]
</script>
