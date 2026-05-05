<template>
  <nav
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="scrolled ? 'bg-white/95 dark:bg-gray-900/95 backdrop-blur shadow-md' : 'bg-transparent'"
    style="background: linear-gradient(135deg, #0f3d2e 0%, #1a4a3a 100%)"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <a href="/" class="flex items-center gap-2 font-bold text-xl text-white">
          <div class="w-9 h-9 rounded-xl bg-teal-500 flex items-center justify-center text-white font-bold text-base">
            {{ profile?.name?.charAt(0) || 'P' }}
          </div>
          <span>{{ profile?.name?.split(' ')[0] || 'Portfolio' }}</span>
        </a>

        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-1">
          <a
            v-for="link in navLinks"
            :key="link.href"
            :href="link.href"
            class="px-3 py-2 text-sm font-medium rounded-lg transition-colors text-white/90 hover:text-white hover:bg-white/10"
            :class="link.active ? 'bg-white/15 text-white font-semibold' : ''"
          >{{ link.label }}</a>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2">
          <!-- Language toggle -->
          <button
            @click="$emit('toggle-locale')"
            class="px-3 py-1.5 text-sm font-semibold rounded-lg border border-white/40 text-white hover:bg-white/10 transition-colors"
          >{{ currentLocale === 'fr' ? 'EN' : 'FR' }}</button>

          <!-- Mobile menu button -->
          <button
            @click="mobileMenu = !mobileMenu"
            class="md:hidden w-9 h-9 rounded-lg flex items-center justify-center text-white hover:bg-white/10"
          >
            <span class="text-xl">{{ mobileMenu ? '✕' : '☰' }}</span>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div v-if="mobileMenu" class="md:hidden bg-[#0f3d2e] rounded-xl shadow-xl mt-1 mb-3 overflow-hidden border border-white/10">
        <a
          v-for="link in navLinks"
          :key="link.href"
          :href="link.href"
          @click="mobileMenu = false"
          class="block px-4 py-3 text-white/80 hover:bg-white/10 hover:text-white transition-colors font-medium text-sm"
          :class="link.active ? 'bg-white/15 text-white font-semibold' : ''"
        >{{ link.label }}</a>
      </div>
    </div>
  </nav>

  <!-- Spacer so content doesn't go under fixed nav -->
  <div class="h-16"></div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const props = defineProps({
  currentLocale: { type: String, default: 'fr' },
  activePage: { type: String, default: '' },
})

defineEmits(['toggle-locale'])

const page = usePage()
const profile = computed(() => page.props.profile)
const mobileMenu = ref(false)

const navLinks = computed(() => {
  const isFr = props.currentLocale === 'fr'
  return [
    { href: '/#home',         label: isFr ? 'Accueil'      : 'Home',          active: false },
    { href: '/#about',        label: isFr ? 'À propos'     : 'About',         active: false },
    { href: '/#skills',       label: isFr ? 'Compétences'  : 'Skills',        active: false },
    { href: '/#parcours',     label: isFr ? 'Parcours'     : 'Journey',       active: false },
    { href: '/#projects',     label: isFr ? 'Projets'      : 'Projects',      active: false },
    { href: '/#testimonials', label: isFr ? 'Témoignages'  : 'Testimonials',  active: false },
    { href: '/#contact',      label: 'Contact',                                active: false },
    { href: '/blog',          label: 'Blog',                                   active: props.activePage === 'blog' },
  ]
})
</script>
