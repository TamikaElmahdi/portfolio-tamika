<template>
  <div class="min-h-screen bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col fixed h-full z-10">
      <div class="p-6 border-b border-gray-700">
        <Link href="/admin" class="flex items-center gap-3">
          <div class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">P</div>
          <div>
            <div class="font-bold text-white">Portfolio</div>
            <div class="text-xs text-gray-400">Admin Panel</div>
          </div>
        </Link>
      </div>

      <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <Link
          href="/admin"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors"
          :class="isActive('/admin') ? 'bg-teal-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white'"
        >
          <span class="text-lg">📊</span>
          <span>Tableau de bord</span>
        </Link>

        <Link
          href="/admin/profile"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors"
          :class="isActive('/admin/profile') ? 'bg-teal-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white'"
        >
          <span class="text-lg">👤</span>
          <span>Profil</span>
        </Link>

        <div class="pt-4 pb-2">
          <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3">Contenu</p>
        </div>

        <Link
          v-for="item in navItems"
          :key="item.href"
          :href="item.href"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors"
          :class="isActive(item.href) ? 'bg-teal-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white'"
        >
          <span class="text-lg">{{ item.icon }}</span>
          <span>{{ item.label }}</span>
        </Link>
      </nav>

      <div class="p-4 border-t border-gray-700">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
            {{ user?.name?.charAt(0) || 'A' }}
          </div>
          <div>
            <div class="text-sm font-medium text-white">{{ user?.name || 'Admin' }}</div>
            <div class="text-xs text-gray-400">{{ user?.email }}</div>
          </div>
        </div>
        <Link
          href="/logout"
          method="post"
          as="button"
          class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-gray-800 rounded-lg transition-colors"
        >
          <span>🚪</span>
          <span>Déconnexion</span>
        </Link>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen">
      <!-- Top Bar -->
      <header class="bg-white border-b border-gray-200 px-6 py-4 sticky top-0 z-10">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-xl font-bold text-gray-900">{{ title }}</h1>
            <p v-if="subtitle" class="text-sm text-gray-500">{{ subtitle }}</p>
          </div>
          <div class="flex items-center gap-3">
            <Link
              href="/"
              target="_blank"
              class="flex items-center gap-2 px-4 py-2 text-sm text-teal-600 border border-teal-600 rounded-lg hover:bg-teal-50 transition-colors"
            >
              <span>🔗</span>
              <span>Voir le site</span>
            </Link>
          </div>
        </div>
      </header>

      <!-- Flash Messages -->
      <div v-if="$page.props.flash?.success" class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
        <span>✅</span>
        <span>{{ $page.props.flash.success }}</span>
      </div>

      <div class="p-6">
        <slot />
      </div>
    </main>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

defineProps({
  title: { type: String, default: 'Admin' },
  subtitle: { type: String, default: '' },
})

const page = usePage()
const user = computed(() => page.props.auth?.user)

const navItems = [
  { href: '/admin/experiences', icon: '💼', label: 'Expériences' },
  { href: '/admin/educations', icon: '🎓', label: 'Formations' },
  { href: '/admin/skills', icon: '⚡', label: 'Compétences' },
  { href: '/admin/certificates', icon: '🏆', label: 'Certifications' },
  { href: '/admin/projects', icon: '🚀', label: 'Projets' },
  { href: '/admin/hobbies', icon: '🎯', label: 'Loisirs' },
  { href: '/admin/testimonials', icon: '💬', label: 'Témoignages' },
  { href: '/admin/messages', icon: '✉️', label: 'Messages' },
]

const isActive = (href) => {
  if (href === '/admin') {
    return window.location.pathname === '/admin'
  }
  return window.location.pathname.startsWith(href)
}
</script>
