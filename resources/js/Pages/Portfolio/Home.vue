import { Head } from '@inertiajs/vue3'

<template>
    <Head>
    <title>{{ profile?.name }} — Full-Stack Developer</title>
    <meta name="description" :content="profile?.bio_en?.substring(0, 160)" />
    <meta name="keywords" content="Full-Stack Developer, Laravel, Vue.js, Angular, .NET, PHP, Morocco" />

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://elmahditamika.com" />
    <meta property="og:title" :content="profile?.name + ' — Full-Stack Developer'" />
    <meta property="og:description" :content="profile?.bio_en?.substring(0, 160)" />
    <meta property="og:image" :content="profile?.avatar ? 'https://elmahditamika.com/storage/' + profile.avatar : 'https://elmahditamika.com/favicon.svg'" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="profile?.name + ' — Full-Stack Developer'" />
    <meta name="twitter:description" :content="profile?.bio_en?.substring(0, 160)" />
    <meta name="twitter:image" :content="profile?.avatar ? 'https://elmahditamika.com/storage/' + profile.avatar : 'https://elmahditamika.com/favicon.svg'" />

    <!-- Canonical -->
    <link rel="canonical" href="https://elmahditamika.com" />
  </Head>
  <div :class="['min-h-screen font-sans', darkMode ? 'dark' : '']">
    <!-- Navigation -->
    <nav
      class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
      :class="scrolled ? 'bg-white/95 dark:bg-gray-900/95 backdrop-blur shadow-md' : 'bg-transparent'"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <!-- Logo -->
          <a href="#home" class="flex items-center gap-2 font-bold text-xl" :class="scrolled ? 'text-gray-900 dark:text-white' : 'text-white'">
            <div class="w-9 h-9 rounded-xl bg-teal-500 flex items-center justify-center text-white font-bold">
              {{ profile?.name?.charAt(0) || 'P' }}
            </div>
            <span>{{ profile?.name?.split(' ')[0] || 'Portfolio' }}</span>
          </a>

          <!-- Desktop Nav -->
          <div class="hidden md:flex items-center gap-1">
            <a
              v-for="link in navLinks"
              :key="link.id"
              :href="'#' + link.id"
              class="px-3 py-2 text-sm font-medium rounded-lg transition-colors"
              :class="scrolled ? 'text-gray-700 dark:text-gray-200 hover:text-teal-600 hover:bg-teal-50 dark:hover:bg-teal-900/30' : 'text-white/90 hover:text-white hover:bg-white/10'"
            >
              {{ link.label }}
            </a>
            <a
              href="/blog"
              class="px-3 py-2 text-sm font-medium rounded-lg transition-colors"
              :class="scrolled ? 'text-gray-700 dark:text-gray-200 hover:text-teal-600 hover:bg-teal-50 dark:hover:bg-teal-900/30' : 'text-white/90 hover:text-white hover:bg-white/10'"
            >
              {{ currentLocale === 'fr' ? 'Blog' : 'Blog' }}
            </a>
          </div>

          <!-- Actions -->
          <div class="flex items-center gap-2">
            <!-- Language toggle -->
            <button
              @click="toggleLocale"
              class="px-3 py-1.5 text-sm font-semibold rounded-lg border transition-colors"
              :class="scrolled ? 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:border-teal-500 hover:text-teal-600' : 'border-white/40 text-white hover:bg-white/10'"
            >
              {{ currentLocale === 'fr' ? 'EN' : 'FR' }}
            </button>


            <!-- Dark mode toggle -->
            <button
              @click="darkMode = !darkMode"
              class="w-9 h-9 rounded-lg flex items-center justify-center transition-colors"
              :class="scrolled ? 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' : 'text-white hover:bg-white/10'"
            >
              {{ darkMode ? '☀️' : '🌙' }}
            </button>

            <!-- Mobile menu -->
            <button
              @click="mobileMenu = !mobileMenu"
              class="md:hidden w-9 h-9 rounded-lg flex items-center justify-center"
              :class="scrolled ? 'text-gray-700 hover:bg-gray-100' : 'text-white hover:bg-white/10'"
            >
              <span class="text-xl">{{ mobileMenu ? '✕' : '☰' }}</span>
            </button>
          </div>
        </div>

        <!-- Mobile Menu -->
        <div v-if="mobileMenu" class="md:hidden bg-white dark:bg-gray-900 rounded-xl shadow-xl mt-2 mb-4 overflow-hidden">
          <a
            v-for="link in navLinks"
            :key="link.id"
            :href="'#' + link.id"
            @click="mobileMenu = false"
            class="block px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-teal-50 dark:hover:bg-teal-900/30 hover:text-teal-600 transition-colors font-medium"
          >
            {{ link.label }}
          </a>
          <a
            href="/blog"
            @click="mobileMenu = false"
            class="block px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-teal-50 dark:hover:bg-teal-900/30 hover:text-teal-600 transition-colors font-medium"
          >
            Blog
          </a>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden" style="background: linear-gradient(135deg, #0f3d2e 0%, #1a4a3a 40%, #2d7a5f 100%);">
      <!-- Background decorative elements -->
      <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-10 w-64 h-64 bg-teal-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
        <!-- Grid pattern -->
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 40px 40px;"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 w-full">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left content -->
          <div class="text-white space-y-6">
            <!-- Available badge -->
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur px-4 py-2 rounded-full text-sm font-medium">
              <span class="w-2 h-2 rounded-full animate-pulse" :class="profile?.available ? 'bg-green-400' : 'bg-red-400'"></span>
              {{ profile?.available ? t('hero.available') : t('hero.not_available') }}
            </div>

            <!-- Greeting -->
            <div>
              <p class="text-teal-300 text-lg font-medium mb-2">{{ t('hero.greeting') }}</p>
              <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
                {{ profile?.name || 'Développeur Web' }}
              </h1>
              <div class="mt-3 h-1.5 w-24 bg-gradient-to-r from-teal-400 to-green-400 rounded-full"></div>
            </div>

            <!-- Title -->
            <p class="text-2xl sm:text-3xl font-semibold text-teal-200">
              {{ currentLocale === 'fr' ? (profile?.title_fr || 'Développeur Web Full Stack') : (profile?.title_en || 'Full Stack Web Developer') }}
            </p>

            <!-- Bio excerpt -->
            <p class="text-white/70 text-lg leading-relaxed max-w-xl">
              {{ currentLocale === 'fr' ? (profile?.bio_fr || '')?.substring(0, 180) + '...' : (profile?.bio_en || '')?.substring(0, 180) + '...' }}
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-4">
              <a
                href="#projects"
                class="inline-flex items-center gap-2 bg-teal-500 hover:bg-teal-400 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-teal-500/30 hover:-translate-y-0.5"
              >
                <span>🚀</span>
                {{ t('hero.cta_projects') }}
              </a>
              <a
                href="#contact"
                class="inline-flex items-center gap-2 bg-white/10 backdrop-blur hover:bg-white/20 text-white font-semibold px-6 py-3 rounded-xl border border-white/20 transition-all duration-200 hover:-translate-y-0.5"
              >
                <span>✉️</span>
                {{ t('hero.cta_contact') }}
              </a>
            </div>

            <!-- Stats -->
            <div class="flex flex-wrap gap-8 pt-4">
              <div class="text-center">
                <div class="text-3xl font-extrabold text-white">{{ profile?.years_experience || '0' }}+</div>
                <div class="text-sm text-teal-300">{{ t('hero.years_exp') }}</div>
              </div>
              <div class="text-center">
                <div class="text-3xl font-extrabold text-white">{{ projects?.length || '0' }}+</div>
                <div class="text-sm text-teal-300">{{ t('hero.projects_done') }}</div>
              </div>
              <div class="text-center">
                <div class="text-3xl font-extrabold text-white">{{ skills ? Object.values(skills).flat().length : '0' }}+</div>
                <div class="text-sm text-teal-300">Technologies</div>
              </div>
            </div>

            <!-- Social links -->
            <div class="flex items-center gap-3 pt-2">
              <a
                v-if="profile?.github"
                :href="profile.github"
                target="_blank"
                class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white transition-colors"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
              </a>
              <a
                v-if="profile?.linkedin"
                :href="profile.linkedin"
                target="_blank"
                class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white transition-colors"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
              </a>
              <a
                v-if="profile?.email"
                :href="'mailto:' + profile.email"
                class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white transition-colors"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              </a>
            </div>
          </div>

          <!-- Right - Profile image -->
          <div class="relative flex justify-center items-center">
            <div class="relative">
              <!-- Decorative rings -->
              <div class="absolute inset-0 rounded-full border-2 border-teal-400/30 animate-spin" style="animation-duration: 20s; width: 360px; height: 360px; top: -30px; left: -30px;"></div>
              <div class="absolute inset-0 rounded-full border border-teal-300/20" style="width: 420px; height: 420px; top: -60px; left: -60px;"></div>

              <!-- Avatar -->
              <div class="relative w-72 h-72 rounded-full overflow-hidden border-4 border-teal-400/50 shadow-2xl shadow-teal-900/50">
                <img
                  v-if="profile?.avatar"
                  :src="'/storage/' + profile.avatar"
                  :alt="profile?.name"
                  class="w-full h-full object-cover"
                />
                <div v-else class="w-full h-full bg-gradient-to-br from-teal-400 to-teal-700 flex items-center justify-center">
                  <span class="text-9xl text-white/80">👨‍💻</span>
                </div>
              </div>

              <!-- Floating elements -->
              <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-lg p-3 flex items-center gap-2">
                <span class="text-2xl">⭐</span>
                <div>
                  <div class="text-xs text-gray-500">Experience</div>
                  <div class="font-bold text-gray-900">{{ profile?.years_experience || 0 }}+ ans</div>
                </div>
              </div>

              <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-lg p-3 flex items-center gap-2">
                <span class="text-2xl">✅</span>
                <div>
                  <div class="text-xs text-gray-500">Projets</div>
                  <div class="font-bold text-gray-900">{{ projects?.length || 0 }}+ réalisés</div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/50 animate-bounce">
          <span class="text-xs">{{ t('hero.scroll') }}</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <span class="inline-block bg-teal-50 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-sm font-semibold px-4 py-2 rounded-full mb-4">{{ t('about.title') }}</span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">{{ t('about.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left: Avatar + cards -->
          <div class="relative flex justify-center">
            <div class="relative">
              <div class="w-80 h-80 rounded-3xl overflow-hidden shadow-2xl">
                <img
                  v-if="profile?.avatar"
                  :src="'/storage/' + profile.avatar"
                  :alt="profile?.name"
                  class="w-full h-full object-cover"
                />
                <div v-else class="w-full h-full bg-gradient-to-br from-teal-100 to-teal-200 flex items-center justify-center">
                  <span class="text-8xl">👨‍💻</span>
                </div>
              </div>

              <!-- Info cards -->
              <div class="absolute -bottom-6 -right-6 bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-4">
                <div class="text-3xl font-extrabold text-teal-600">{{ profile?.years_experience || 0 }}+</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ t('about.experience') }}</div>
              </div>

              <div class="absolute -top-4 -left-4 bg-teal-600 rounded-2xl shadow-xl p-4 text-white">
                <div class="text-2xl font-extrabold">{{ projects?.length || 0 }}+</div>
                <div class="text-xs opacity-80">Projets</div>
              </div>
            </div>
          </div>

          <!-- Right: Bio + info -->
          <div class="space-y-6">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ profile?.name }}</h3>
            <p class="text-teal-600 dark:text-teal-400 font-semibold text-lg">
              {{ currentLocale === 'fr' ? profile?.title_fr : profile?.title_en }}
            </p>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
              {{ currentLocale === 'fr' ? profile?.bio_fr : profile?.bio_en }}
            </p>

            <!-- Info grid -->
            <div class="grid sm:grid-cols-2 gap-4">
              <div v-if="profile?.location" class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <span class="text-2xl">📍</span>
                <div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ t('about.location') }}</div>
                  <div class="text-gray-900 dark:text-white font-medium">{{ profile.location }}</div>
                </div>
              </div>
              <div v-if="profile?.email" class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <span class="text-2xl">✉️</span>
                <div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ t('about.email') }}</div>
                  <div class="text-gray-900 dark:text-white font-medium text-sm">{{ profile.email }}</div>
                </div>
              </div>
              <div v-if="profile?.phone" class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <span class="text-2xl">📱</span>
                <div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ t('about.phone') }}</div>
                  <div class="text-gray-900 dark:text-white font-medium">{{ profile.phone }}</div>
                </div>
              </div>
              <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <span class="text-2xl">{{ profile?.available ? '🟢' : '🔴' }}</span>
                <div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">Disponibilité</div>
                  <div class="font-medium" :class="profile?.available ? 'text-green-600' : 'text-red-500'">
                    {{ profile?.available ? t('hero.available') : t('hero.not_available') }}
                  </div>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-3 pt-2">
              <a
                v-if="profile?.cv_path"
                :href="'/storage/' + profile.cv_path"
                download
                class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors"
              >
                <span>📄</span>
                {{ t('about.download_cv') }}
              </a>
              <a
                v-if="profile?.github"
                :href="profile.github"
                target="_blank"
                class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors"
              >
                <span>💻</span> GitHub
              </a>
              <a
                v-if="profile?.linkedin"
                :href="profile.linkedin"
                target="_blank"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors"
              >
                <span>🔗</span> LinkedIn
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #0f3d2e 0%, #1a4a3a 50%, #0f3d2e 100%);">
      <!-- Background pattern -->
      <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
      <div class="absolute top-0 left-0 w-96 h-96 bg-teal-400/10 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-0 right-0 w-80 h-80 bg-green-400/10 rounded-full blur-3xl pointer-events-none"></div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
          <span class="inline-flex items-center gap-2 bg-white/10 text-teal-300 text-sm font-semibold px-4 py-2 rounded-full mb-4 backdrop-blur">
            <span>⚡</span> {{ t('skills.title') }}
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white">{{ t('skills.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-400 mx-auto rounded-full"></div>
        </div>

        <div class="space-y-14">
          <div v-for="(categorySkills, category) in skills" :key="category">
            <!-- Category label -->
            <div class="flex items-center gap-3 mb-6">
              <div class="w-9 h-9 rounded-xl bg-white/10 backdrop-blur flex items-center justify-center text-xl border border-white/20">
                {{ getCategoryIcon(category) }}
              </div>
              <h3 class="text-lg font-bold text-white tracking-wide uppercase">
                {{ t('skills.' + category) || category }}
              </h3>
              <div class="flex-1 h-px bg-white/10"></div>
              <span class="text-xs text-teal-300 font-semibold">{{ categorySkills.length }} skills</span>
            </div>

            <!-- Skills grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
              <div
                v-for="skill in categorySkills"
                :key="skill.id"
                class="group relative rounded-2xl p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl cursor-default"
                style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); backdrop-filter: blur(8px);"
              >
                <!-- Glow on hover -->
                <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                  style="background: linear-gradient(135deg, rgba(82,183,136,0.15), rgba(45,122,95,0.1));"></div>

                <div class="relative">
                  <!-- Top row -->
                  <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-xl border border-white/20 group-hover:border-teal-400/50 transition-colors">
                        {{ skill.icon || '⚡' }}
                      </div>
                      <span class="font-semibold text-white text-sm leading-tight">{{ skill.name }}</span>
                    </div>
                    <span class="text-sm font-extrabold text-teal-400">{{ skill.level }}%</span>
                  </div>

                  <!-- Progress bar -->
                  <div class="h-1.5 rounded-full overflow-hidden" style="background: rgba(255,255,255,0.1);">
                    <div
                      class="h-full rounded-full transition-all duration-1000"
                      :style="{
                        width: skill.level + '%',
                        background: 'linear-gradient(90deg, #52b788, #2d7a5f)'
                      }"
                    ></div>
                  </div>

                  <!-- Level label -->
                  <div class="mt-2 text-right">
                    <span class="text-xs font-medium"
                      :style="{ color: skill.level >= 90 ? '#52b788' : skill.level >= 75 ? '#3d9970' : '#2d7a5f' }"
                    >
                      {{ skill.level >= 90 ? 'Expert' : skill.level >= 75 ? 'Avancé' : skill.level >= 60 ? 'Intermédiaire' : 'Débutant' }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Timeline Section -->
    <section id="parcours" class="py-20 bg-white dark:bg-gray-900 overflow-hidden">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
          <span class="inline-block bg-teal-50 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-sm font-semibold px-4 py-2 rounded-full mb-4">{{ t('timeline.title') }}</span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">{{ t('timeline.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-500 mx-auto rounded-full"></div>
        </div>

        <!-- Filter tabs -->
        <div class="flex justify-center gap-3 mb-14 flex-wrap">
          <button
            @click="timelineFilter = 'all'"
            class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200"
            :class="timelineFilter === 'all'
              ? 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 shadow-md'
              : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'"
          >
            {{ t('timeline.filter_all') }}
          </button>
          <button
            @click="timelineFilter = 'experience'"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200"
            :class="timelineFilter === 'experience'
              ? 'bg-teal-600 text-white shadow-md'
              : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-teal-50 dark:hover:bg-teal-900/20'"
          >
            <span>💼</span> {{ t('timeline.filter_exp') }}
          </button>
          <button
            @click="timelineFilter = 'education'"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200"
            :class="timelineFilter === 'education'
              ? 'bg-indigo-600 text-white shadow-md'
              : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20'"
          >
            <span>🎓</span> {{ t('timeline.filter_edu') }}
          </button>
        </div>

        <!-- Timeline -->
        <div class="relative">
          <!-- Vertical line — center on desktop, left on mobile -->
          <div
            class="absolute left-1/2 top-0 bottom-0 w-0.5 -translate-x-1/2 hidden md:block"
            style="background: linear-gradient(to bottom, #14b8a6 0%, #818cf8 100%);"
          ></div>
          <div
            class="absolute left-5 top-0 bottom-0 w-0.5 md:hidden"
            style="background: linear-gradient(to bottom, #14b8a6 0%, #818cf8 100%);"
          ></div>

          <div class="space-y-10">
            <div
              v-for="(item, index) in filteredTimelineItems"
              :key="item.id"
              :data-timeline-id="item.id"
              class="relative flex items-start md:items-center pl-14 md:pl-0"
              :class="index % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse'"
            >
              <!-- Card -->
              <div
                class="w-full md:w-[calc(50%-2.5rem)] transition-all duration-700 ease-out"
                :class="index % 2 === 0 ? 'md:mr-10' : 'md:ml-10'"
                :style="{
                  opacity: visibleItems.has(item.id) ? 1 : 0,
                  transform: visibleItems.has(item.id)
                    ? 'translateX(0)'
                    : (index % 2 === 0 ? 'translateX(-36px)' : 'translateX(36px)'),
                  transitionDelay: visibleItems.has(item.id) ? ((index % 4) * 0.1) + 's' : '0s',
                }"
              >
                <div
                  class="group rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border hover:-translate-y-1"
                  :class="item.type === 'experience'
                    ? 'bg-white dark:bg-gray-800 border-gray-100 dark:border-gray-700 hover:border-teal-300 dark:hover:border-teal-700'
                    : 'bg-white dark:bg-gray-800 border-gray-100 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-700'"
                >
                  <!-- Colored top accent -->
                  <div
                    class="h-1 w-full"
                    :class="item.type === 'experience'
                      ? 'bg-gradient-to-r from-teal-400 to-teal-600'
                      : 'bg-gradient-to-r from-indigo-400 to-indigo-600'"
                  ></div>

                  <div class="p-6">
                    <!-- Type badge + current badge -->
                    <div
                      class="flex items-center gap-2 mb-3 flex-wrap"
                      :class="index % 2 === 0 ? 'md:justify-end' : ''"
                    >
                      <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold"
                        :class="item.type === 'experience'
                          ? 'bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-300'
                          : 'bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300'"
                      >
                        <span>{{ item.type === 'experience' ? '💼' : '🎓' }}</span>
                        {{ item.type === 'experience' ? t('timeline.exp_label') : t('timeline.edu_label') }}
                      </span>
                      <span
                        v-if="item.isCurrent"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400"
                      >
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse inline-block"></span>
                        {{ t('experience.current') }}
                      </span>
                    </div>

                    <!-- Title -->
                    <h3
                      class="text-lg font-bold text-gray-900 dark:text-white leading-tight"
                      :class="index % 2 === 0 ? 'md:text-right' : ''"
                    >
                      {{ item.title }}
                    </h3>

                    <!-- Organization + location -->
                    <div
                      class="mt-1.5 flex flex-wrap items-center gap-x-2 gap-y-1"
                      :class="index % 2 === 0 ? 'md:justify-end' : ''"
                    >
                      <span
                        class="font-semibold text-sm"
                        :class="item.type === 'experience' ? 'text-teal-600 dark:text-teal-400' : 'text-indigo-600 dark:text-indigo-400'"
                      >{{ item.organization }}</span>
                      <span v-if="item.subtitle" class="text-gray-500 dark:text-gray-400 text-sm">• {{ item.subtitle }}</span>
                      <span v-if="item.location" class="text-gray-400 dark:text-gray-500 text-xs">📍 {{ item.location }}</span>
                    </div>

                    <!-- Period + contract badge -->
                    <div
                      class="mt-2 flex flex-wrap items-center gap-2 text-xs text-gray-500 dark:text-gray-400"
                      :class="index % 2 === 0 ? 'md:justify-end' : ''"
                    >
                      <span class="inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ item.period }}
                      </span>
                      <span
                        v-if="item.badge"
                        class="px-2 py-0.5 rounded-full font-medium bg-teal-50 dark:bg-teal-900/20 text-teal-600 dark:text-teal-400 border border-teal-200 dark:border-teal-800"
                      >{{ item.badge }}</span>
                    </div>

                    <!-- Description -->
                    <p
                      v-if="item.description"
                      class="mt-3 text-sm text-gray-600 dark:text-gray-300 leading-relaxed"
                      :class="index % 2 === 0 ? 'md:text-right' : ''"
                    >{{ item.description }}</p>
                  </div>
                </div>
              </div>

              <!-- Center dot (desktop) -->
              <div
                class="absolute left-1/2 w-5 h-5 rounded-full border-4 border-white dark:border-gray-900 shadow-lg z-10 hidden md:block"
                :class="item.type === 'experience' ? 'bg-teal-500' : 'bg-indigo-500'"
                :style="{
                  transform: `translateX(-50%) scale(${visibleItems.has(item.id) ? 1 : 0.2})`,
                  opacity: visibleItems.has(item.id) ? 1 : 0,
                  transition: 'all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)',
                  transitionDelay: visibleItems.has(item.id) ? ((index % 4) * 0.1 + 0.15) + 's' : '0s',
                }"
              ></div>

              <!-- Mobile dot -->
              <div
                class="absolute left-3 top-7 w-4 h-4 rounded-full border-4 border-white dark:border-gray-900 shadow-md z-10 md:hidden"
                :class="item.type === 'experience' ? 'bg-teal-500' : 'bg-indigo-500'"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Certificates Section -->
    <section id="certificates" class="py-20 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <span class="inline-block bg-teal-50 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-sm font-semibold px-4 py-2 rounded-full mb-4">{{ t('certificates.title') }}</span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">{{ t('certificates.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="cert in certificates"
            :key="cert.id"
            class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-200 hover:-translate-y-1 border border-gray-100 dark:border-gray-700 flex flex-col"
          >
            <div class="flex items-start gap-4 mb-4">
              <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-teal-500 to-teal-700 flex items-center justify-center flex-shrink-0 shadow-md">
                <span class="text-2xl">🏆</span>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 dark:text-white leading-tight">
                  {{ currentLocale === 'fr' ? cert.title_fr : cert.title_en }}
                </h3>
                <p class="text-teal-600 dark:text-teal-400 font-medium text-sm mt-1">{{ cert.organization }}</p>
              </div>
            </div>
            <p v-if="currentLocale === 'fr' ? cert.description_fr : cert.description_en" class="text-gray-600 dark:text-gray-300 text-sm flex-1 mb-4">
              {{ currentLocale === 'fr' ? cert.description_fr : cert.description_en }}
            </p>
            <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400">
              <div class="flex items-center gap-1">
                <span>📅</span> {{ t('certificates.issued') }}: {{ formatDate(cert.issued_date) }}
              </div>
              <div v-if="cert.expiry_date" class="flex items-center gap-1">
                <span>⏰</span> {{ t('certificates.expires') }}: {{ formatDate(cert.expiry_date) }}
              </div>
            </div>
            <a
              v-if="cert.credential_url"
              :href="cert.credential_url"
              target="_blank"
              class="mt-4 inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium text-sm"
            >
              <span>🔗</span> {{ t('certificates.view') }}
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #0f3d2e 0%, #1a4a3a 50%, #2d7a5f 100%);">
      <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 40px 40px;"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-16">
          <span class="inline-block bg-white/10 text-teal-200 text-sm font-semibold px-4 py-2 rounded-full mb-4">{{ t('projects.title') }}</span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white">{{ t('projects.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-400 mx-auto rounded-full"></div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="project in projects"
            :key="project.id"
            class="bg-white/10 backdrop-blur rounded-2xl overflow-hidden hover:bg-white/15 transition-all duration-200 hover:-translate-y-1 border border-white/10 cursor-pointer group"
            @click="openProject(project)"
          >
            <!-- Project image -->
            <div class="h-48 bg-gradient-to-br from-teal-600 to-teal-800 relative overflow-hidden">
              <img
                v-if="project.images && project.images.length"
                :src="'/storage/' + project.images[0].path"
                :alt="currentLocale === 'fr' ? project.title_fr : project.title_en"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
              />
              <div v-else class="w-full h-full flex items-center justify-center">
                <span class="text-6xl opacity-40">🚀</span>
              </div>
              <!-- Image count badge -->
              <div v-if="project.images && project.images.length > 1" class="absolute bottom-3 right-3 bg-black/50 text-white text-xs px-2 py-1 rounded-full backdrop-blur-sm">
                📷 {{ project.images.length }}
              </div>
              <div v-if="project.featured" class="absolute top-3 right-3 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full">
                ⭐ Featured
              </div>
              <!-- View details overlay -->
              <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                <span class="opacity-0 group-hover:opacity-100 transition-opacity bg-white/20 backdrop-blur text-white text-sm font-semibold px-4 py-2 rounded-full border border-white/30">
                  {{ t('projects.view_details') }}
                </span>
              </div>
            </div>

            <div class="p-6">
              <h3 class="text-lg font-bold text-white mb-2">
                {{ currentLocale === 'fr' ? project.title_fr : project.title_en }}
              </h3>
              <p class="text-white/70 text-sm leading-relaxed mb-4">
                {{ (currentLocale === 'fr' ? project.description_fr : project.description_en)?.substring(0, 120) }}...
              </p>

              <!-- Tech tags -->
              <div class="flex flex-wrap gap-2 mb-4">
                <span
                  v-for="tech in (project.technologies || []).slice(0, 4)"
                  :key="tech"
                  class="px-2 py-1 bg-teal-500/30 text-teal-200 text-xs font-medium rounded-lg border border-teal-400/20"
                >
                  {{ tech }}
                </span>
                <span v-if="(project.technologies || []).length > 4" class="px-2 py-1 bg-white/10 text-white/50 text-xs rounded-lg">
                  +{{ (project.technologies || []).length - 4 }}
                </span>
              </div>

              <!-- Links -->
              <div class="flex items-center gap-3" @click.stop>
                <a
                  v-if="project.demo_url"
                  :href="project.demo_url"
                  target="_blank"
                  class="flex-1 flex items-center justify-center gap-2 py-2 bg-teal-500 hover:bg-teal-400 text-white text-sm font-semibold rounded-xl transition-colors"
                >
                  <span>🔗</span> {{ t('projects.demo') }}
                </a>
                <a
                  v-if="project.github_url"
                  :href="project.github_url"
                  target="_blank"
                  class="flex-1 flex items-center justify-center gap-2 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-semibold rounded-xl transition-colors border border-white/20"
                >
                  <span>💻</span> GitHub
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Project Detail Modal -->
    <Teleport to="body">
      <Transition name="modal">
        <div
          v-if="activeProject"
          class="fixed inset-0 z-50 flex items-center justify-center p-4"
          @click.self="closeProject"
        >
          <!-- Backdrop -->
          <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="closeProject"></div>

          <!-- Modal -->
          <div class="relative bg-[#0f3d2e] border border-white/10 rounded-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto shadow-2xl">

            <!-- Close button -->
            <button
              @click="closeProject"
              class="absolute top-4 right-4 z-10 w-9 h-9 flex items-center justify-center bg-white/10 hover:bg-white/20 text-white rounded-full transition-colors"
            >✕</button>

            <!-- Image carousel -->
            <div v-if="activeProject.images && activeProject.images.length" class="relative h-72 sm:h-96 bg-gradient-to-br from-teal-700 to-teal-900 overflow-hidden rounded-t-2xl">
              <img
                :src="'/storage/' + activeProject.images[carouselIndex].path"
                :alt="currentLocale === 'fr' ? activeProject.title_fr : activeProject.title_en"
                class="w-full h-full object-cover transition-opacity duration-300"
              />
              <!-- Prev / Next -->
              <template v-if="activeProject.images.length > 1">
                <button
                  @click="carouselIndex = (carouselIndex - 1 + activeProject.images.length) % activeProject.images.length"
                  class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center bg-black/40 hover:bg-black/60 text-white rounded-full transition-colors"
                >‹</button>
                <button
                  @click="carouselIndex = (carouselIndex + 1) % activeProject.images.length"
                  class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center bg-black/40 hover:bg-black/60 text-white rounded-full transition-colors"
                >›</button>
                <!-- Dots -->
                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
                  <button
                    v-for="(_, i) in activeProject.images"
                    :key="i"
                    @click="carouselIndex = i"
                    class="w-2 h-2 rounded-full transition-all"
                    :class="i === carouselIndex ? 'bg-white w-4' : 'bg-white/40'"
                  ></button>
                </div>
              </template>
              <!-- Featured badge -->
              <div v-if="activeProject.featured" class="absolute top-4 left-4 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full">
                ⭐ Featured
              </div>
            </div>
            <!-- No image fallback -->
            <div v-else class="h-40 bg-gradient-to-br from-teal-700 to-teal-900 flex items-center justify-center rounded-t-2xl">
              <span class="text-7xl opacity-30">🚀</span>
            </div>

            <!-- Content -->
            <div class="p-6 sm:p-8">
              <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-4">
                {{ currentLocale === 'fr' ? activeProject.title_fr : activeProject.title_en }}
              </h2>
              <p class="text-white/75 leading-relaxed mb-6">
                {{ currentLocale === 'fr' ? activeProject.description_fr : activeProject.description_en }}
              </p>

              <!-- Technologies -->
              <div v-if="activeProject.technologies && activeProject.technologies.length" class="mb-6">
                <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2">Technologies</p>
                <div class="flex flex-wrap gap-2">
                  <span
                    v-for="tech in activeProject.technologies"
                    :key="tech"
                    class="px-3 py-1 bg-teal-500/30 text-teal-200 text-sm font-medium rounded-lg border border-teal-400/20"
                  >{{ tech }}</span>
                </div>
              </div>

              <!-- Links -->
              <div class="flex flex-wrap gap-3">
                <a
                  v-if="activeProject.demo_url"
                  :href="activeProject.demo_url"
                  target="_blank"
                  class="flex items-center gap-2 px-5 py-2.5 bg-teal-500 hover:bg-teal-400 text-white font-semibold rounded-xl transition-colors"
                >
                  <span>🔗</span> {{ t('projects.demo') }}
                </a>
                <a
                  v-if="activeProject.github_url"
                  :href="activeProject.github_url"
                  target="_blank"
                  class="flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-colors border border-white/20"
                >
                  <span>💻</span> GitHub
                </a>
              </div>
            </div>
          </div>
        </div>
      </Transition>
    </Teleport>

    <!-- Hobbies Section -->
    <section id="hobbies" class="py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #0f3d2e 0%, #1a4a3a 50%, #0f3d2e 100%);">
      <!-- Background pattern -->
      <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
      <!-- Blobs -->
      <div class="absolute top-0 right-0 w-96 h-96 bg-teal-400/10 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-0 left-0 w-80 h-80 bg-green-400/10 rounded-full blur-3xl pointer-events-none"></div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
          <span class="inline-flex items-center gap-2 bg-white/10 text-teal-300 text-sm font-semibold px-4 py-2 rounded-full mb-4 backdrop-blur">
            <span>🎯</span> {{ t('hobbies.title') }}
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-white">{{ t('hobbies.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-400 mx-auto rounded-full"></div>
        </div>

        <!-- Cards -->
        <div class="flex flex-wrap justify-center gap-5">
          <div
            v-for="hobby in hobbies"
            :key="hobby.id"
            class="group relative flex items-center gap-4 px-6 py-5 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
            :style="{
              background: 'linear-gradient(135deg, ' + hobby.color + '22, ' + hobby.color + '11)',
              border: '1px solid ' + hobby.color + '50',
            }"
          >
            <!-- Glow on hover -->
            <div
              class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-sm -z-10"
              :style="{ background: hobby.color + '33' }"
            ></div>

            <!-- Icon circle -->
            <div
              class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl shrink-0 shadow-lg"
              :style="{ background: hobby.color + '30', border: '1px solid ' + hobby.color + '60' }"
            >
              {{ hobby.icon || '🎯' }}
            </div>

            <!-- Text -->
            <div>
              <span class="block font-bold text-white text-base">
                {{ currentLocale === 'fr' ? hobby.name_fr : hobby.name_en }}
              </span>
              <span class="block text-xs mt-0.5" :style="{ color: hobby.color }">Passion</span>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-white dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
          <span class="inline-block bg-teal-50 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-sm font-semibold px-4 py-2 rounded-full mb-4">
            💬 {{ t('testimonials.title') }}
          </span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">{{ t('testimonials.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-500 mx-auto rounded-full"></div>
        </div>

        <!-- Empty state -->
        <div v-if="!testimonials || testimonials.length === 0" class="text-center py-16 text-gray-400 dark:text-gray-600">
          <div class="text-6xl mb-4">💬</div>
          <p class="text-lg font-medium">Les témoignages arrivent bientôt...</p>
        </div>

        <!-- Carousel -->
        <div v-else class="relative">
          <!-- Cards wrapper -->
          <div class="overflow-hidden">
            <div
              class="flex transition-transform duration-500 ease-in-out"
              :style="{ transform: 'translateX(-' + testimonialIndex * 100 + '%)' }"
            >
              <div
                v-for="testimonial in testimonials"
                :key="testimonial.id"
                class="w-full shrink-0 px-4"
              >
                <div class="max-w-3xl mx-auto bg-gray-50 dark:bg-gray-800 rounded-3xl p-8 sm:p-10 shadow-sm border border-gray-100 dark:border-gray-700 relative">
                  <!-- Quote icon -->
                  <div class="absolute top-8 right-8 text-6xl text-teal-100 dark:text-teal-900 font-serif leading-none select-none">"</div>

                  <!-- Stars -->
                  <div class="flex gap-1 mb-6">
                    <span
                      v-for="n in 5"
                      :key="n"
                      class="text-xl"
                      :class="n <= testimonial.rating ? 'text-yellow-400' : 'text-gray-200 dark:text-gray-700'"
                    >★</span>
                  </div>

                  <!-- Content -->
                  <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed italic mb-8 relative z-10">
                    "{{ currentLocale === 'fr' ? testimonial.content_fr : (testimonial.content_en || testimonial.content_fr) }}"
                  </p>

                  <!-- Author -->
                  <div class="flex items-center gap-4">
                    <!-- Avatar -->
                    <div class="w-14 h-14 rounded-full overflow-hidden bg-teal-100 dark:bg-teal-900 flex items-center justify-center shrink-0 border-2 border-teal-200 dark:border-teal-700">
                      <img
                        v-if="testimonial.author_avatar"
                        :src="'/storage/' + testimonial.author_avatar"
                        :alt="testimonial.author_name"
                        class="w-full h-full object-cover"
                      />
                      <span v-else class="text-2xl text-teal-500">{{ testimonial.author_name?.charAt(0) }}</span>
                    </div>
                    <!-- Info -->
                    <div class="flex-1">
                      <div class="flex items-center gap-2 flex-wrap">
                        <p class="font-bold text-gray-900 dark:text-white">{{ testimonial.author_name }}</p>
                        <span v-if="testimonial.featured" class="text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 font-semibold px-2 py-0.5 rounded-full">⭐ Featured</span>
                      </div>
                      <p class="text-sm text-teal-600 dark:text-teal-400 font-medium">
                        {{ testimonial.author_position }}{{ testimonial.author_company ? ' — ' + testimonial.author_company : '' }}
                      </p>
                      <p v-if="testimonial.relation" class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                        {{ t('testimonials.' + testimonial.relation) }}
                      </p>
                    </div>
                    <!-- LinkedIn -->
                    <a
                      v-if="testimonial.linkedin_url"
                      :href="testimonial.linkedin_url"
                      target="_blank"
                      rel="noopener"
                      class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-xl flex items-center justify-center transition-colors shrink-0"
                      :title="t('testimonials.view_linkedin')"
                    >
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Navigation arrows -->
          <button
            v-if="testimonials.length > 1"
            @click="testimonialIndex = (testimonialIndex - 1 + testimonials.length) % testimonials.length"
            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 sm:-translate-x-6 w-10 h-10 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-full flex items-center justify-center shadow-md hover:bg-teal-50 dark:hover:bg-teal-900/30 hover:text-teal-600 transition-colors"
          >
            ‹
          </button>
          <button
            v-if="testimonials.length > 1"
            @click="testimonialIndex = (testimonialIndex + 1) % testimonials.length"
            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 sm:translate-x-6 w-10 h-10 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-full flex items-center justify-center shadow-md hover:bg-teal-50 dark:hover:bg-teal-900/30 hover:text-teal-600 transition-colors"
          >
            ›
          </button>

          <!-- Dots -->
          <div v-if="testimonials.length > 1" class="flex justify-center gap-2 mt-8">
            <button
              v-for="(_, i) in testimonials"
              :key="i"
              @click="testimonialIndex = i"
              class="w-2.5 h-2.5 rounded-full transition-all duration-300"
              :class="i === testimonialIndex ? 'bg-teal-500 w-6' : 'bg-gray-300 dark:bg-gray-600 hover:bg-teal-300'"
            ></button>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-50 dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <span class="inline-block bg-teal-50 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 text-sm font-semibold px-4 py-2 rounded-full mb-4">{{ t('contact.title') }}</span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">{{ t('contact.subtitle') }}</h2>
          <div class="mt-4 h-1 w-16 bg-teal-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
          <!-- Contact form -->
          <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-sm border border-gray-100 dark:border-gray-700">
            <div v-if="formSuccess" class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
              <span>✅</span> {{ t('contact.success') }}
            </div>
            <form @submit.prevent="submitContact" class="space-y-5">
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ t('contact.name') }}</label>
                <input
                  v-model="form.name"
                  type="text"
                  required
                  class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                  :placeholder="t('contact.name')"
                />
                <span v-if="formErrors.name" class="text-red-500 text-sm">{{ formErrors.name }}</span>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ t('contact.email') }}</label>
                <input
                  v-model="form.email"
                  type="email"
                  required
                  class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                  :placeholder="t('contact.email')"
                />
                <span v-if="formErrors.email" class="text-red-500 text-sm">{{ formErrors.email }}</span>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ t('contact.subject') }}</label>
                <input
                  v-model="form.subject"
                  type="text"
                  required
                  class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                  :placeholder="t('contact.subject')"
                />
                <span v-if="formErrors.subject" class="text-red-500 text-sm">{{ formErrors.subject }}</span>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ t('contact.message') }}</label>
                <textarea
                  v-model="form.message"
                  rows="5"
                  required
                  class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all resize-none"
                  :placeholder="t('contact.message')"
                ></textarea>
                <span v-if="formErrors.message" class="text-red-500 text-sm">{{ formErrors.message }}</span>
              </div>
              <button
                type="submit"
                :disabled="formSubmitting"
                class="w-full flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 disabled:opacity-60 text-white font-semibold py-3 rounded-xl transition-all duration-200 hover:shadow-lg"
              >
                <span>{{ formSubmitting ? '⏳' : '🚀' }}</span>
                {{ formSubmitting ? t('contact.sending') : t('contact.send') }}
              </button>
            </form>
          </div>

          <!-- Contact info -->
          <div class="space-y-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ t('contact.info_title') }}</h3>

            <div class="space-y-4">
              <a
                v-if="profile?.email"
                :href="'mailto:' + profile.email"
                class="flex items-center gap-4 p-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all duration-200 hover:-translate-y-0.5 group"
              >
                <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/30 rounded-xl flex items-center justify-center text-2xl group-hover:bg-teal-600 transition-colors">
                  <span>✉️</span>
                </div>
                <div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">Email</div>
                  <div class="font-semibold text-gray-900 dark:text-white">{{ profile.email }}</div>
                </div>
              </a>

              <a
                v-if="profile?.phone"
                :href="'tel:' + profile.phone"
                class="flex items-center gap-4 p-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all duration-200 hover:-translate-y-0.5 group"
              >
                <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/30 rounded-xl flex items-center justify-center text-2xl group-hover:bg-teal-600 transition-colors">
                  <span>📱</span>
                </div>
                <div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">Téléphone</div>
                  <div class="font-semibold text-gray-900 dark:text-white">{{ profile.phone }}</div>
                </div>
              </a>

              <div
                v-if="profile?.location"
                class="flex items-center gap-4 p-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700"
              >
                <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/30 rounded-xl flex items-center justify-center text-2xl">
                  <span>📍</span>
                </div>
                <div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">Localisation</div>
                  <div class="font-semibold text-gray-900 dark:text-white">{{ profile.location }}</div>
                </div>
              </div>
            </div>

            <!-- Social links -->
            <div>
              <h4 class="font-semibold text-gray-700 mb-4">{{ t('contact.follow') }}</h4>
              <div class="flex gap-3">
                <a
                  v-if="profile?.github"
                  :href="profile.github"
                  target="_blank"
                  class="w-12 h-12 bg-gray-900 hover:bg-gray-700 text-white rounded-xl flex items-center justify-center transition-colors shadow-md hover:shadow-lg"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
                <a
                  v-if="profile?.linkedin"
                  :href="profile.linkedin"
                  target="_blank"
                  class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-xl flex items-center justify-center transition-colors shadow-md hover:shadow-lg"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-sm">
          &copy; {{ new Date().getFullYear() }} {{ profile?.name }}. Tous droits réservés.
        </p>
        <p class="text-xs mt-2 text-gray-600">
          Elmahdi Tamika
        </p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'

const props = defineProps({
  profile: Object,
  experiences: Array,
  educations: Array,
  skills: Object,
  certificates: Array,
  hobbies: Array,
  projects: Array,
  testimonials: Array,
  locale: String,
})

const { t, locale } = useI18n()
const page = usePage()

const currentLocale = ref(props.locale || 'fr')
const darkMode = ref(true)
const scrolled = ref(false)
const mobileMenu = ref(false)
const formSubmitting = ref(false)
const formSuccess = ref(false)
const formErrors = ref({})
const timelineFilter = ref('all')
const visibleItems = ref(new Set())
const testimonialIndex = ref(0)

const activeProject = ref(null)
const carouselIndex = ref(0)

function openProject(project) {
  activeProject.value = project
  carouselIndex.value = 0
  document.body.style.overflow = 'hidden'
}

function closeProject() {
  activeProject.value = null
  document.body.style.overflow = ''
}

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: '',
})

const formatDate = (dateStr) => {
  if (!dateStr) return ''
  const date = new Date(dateStr)
  return date.toLocaleDateString(currentLocale.value === 'fr' ? 'fr-FR' : 'en-US', { month: 'long', year: 'numeric' })
}

const navLinks = computed(() => [
  { id: 'home', label: t('nav.home') },
  { id: 'about', label: t('nav.about') },
  { id: 'skills', label: t('nav.skills') },
  { id: 'parcours', label: t('nav.parcours') },
  { id: 'projects', label: t('nav.projects') },
  { id: 'testimonials', label: t('nav.testimonials') },
  { id: 'contact', label: t('nav.contact') },
])

const timelineItems = computed(() => {
  const items = []
  ;(props.experiences || []).forEach(exp => {
    items.push({
      id: 'exp-' + exp.id,
      type: 'experience',
      sortDate: exp.start_date ? new Date(exp.start_date) : new Date(0),
      title: currentLocale.value === 'fr' ? exp.position_fr : exp.position_en,
      organization: exp.company,
      location: exp.location,
      period: formatDate(exp.start_date) + ' — ' + (exp.is_current ? t('experience.present') : formatDate(exp.end_date)),
      isCurrent: exp.is_current,
      description: currentLocale.value === 'fr' ? exp.description_fr : exp.description_en,
      badge: exp.contract_type,
    })
  })
  ;(props.educations || []).forEach(edu => {
    items.push({
      id: 'edu-' + edu.id,
      type: 'education',
      sortDate: edu.start_year ? new Date(edu.start_year + '-01-01') : new Date(0),
      title: currentLocale.value === 'fr' ? edu.degree_fr : edu.degree_en,
      organization: edu.school,
      subtitle: currentLocale.value === 'fr' ? edu.field_fr : edu.field_en,
      period: edu.start_year + ' — ' + (edu.end_year || (currentLocale.value === 'fr' ? 'Présent' : 'Present')),
      description: currentLocale.value === 'fr' ? edu.description_fr : edu.description_en,
    })
  })
  return items.sort((a, b) => b.sortDate - a.sortDate)
})

const filteredTimelineItems = computed(() => {
  if (timelineFilter.value === 'all') return timelineItems.value
  return timelineItems.value.filter(item => item.type === timelineFilter.value)
})

const handleScroll = () => {
  scrolled.value = window.scrollY > 50
}

let timelineObserver = null

const setupTimelineObserver = async () => {
  await nextTick()
  if (timelineObserver) timelineObserver.disconnect()
  timelineObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.dataset.timelineId
        if (id && !visibleItems.value.has(id)) {
          visibleItems.value = new Set([...visibleItems.value, id])
        }
      }
    })
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' })
  document.querySelectorAll('[data-timeline-id]').forEach(el => {
    timelineObserver.observe(el)
  })
}

watch(filteredTimelineItems, () => {
  setupTimelineObserver()
})

function handleKeydown(e) {
  if (e.key === 'Escape') closeProject()
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  window.addEventListener('keydown', handleKeydown)
  locale.value = currentLocale.value
  setupTimelineObserver()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  window.removeEventListener('keydown', handleKeydown)
  if (timelineObserver) timelineObserver.disconnect()
})

const toggleLocale = () => {
  currentLocale.value = currentLocale.value === 'fr' ? 'en' : 'fr'
  locale.value = currentLocale.value
}

const getCategoryIcon = (category) => {
  const icons = {
    frontend: '🎨',
    backend: '⚙️',
    tools: '🔧',
    other: '📦',
  }
  return icons[category] || '⚡'
}

const submitContact = async () => {
  formSubmitting.value = true
  formErrors.value = {}
  formSuccess.value = false

  router.post('/contact', form.value, {
    onSuccess: () => {
      formSuccess.value = true
      form.value = { name: '', email: '', subject: '', message: '' }
      formSubmitting.value = false
    },
    onError: (errors) => {
      formErrors.value = errors
      formSubmitting.value = false
    },
  })
}
</script>

<style scoped>
.modal-enter-active, .modal-leave-active { transition: opacity 0.2s ease; }
.modal-enter-from, .modal-leave-to { opacity: 0; }
.modal-enter-active .relative, .modal-leave-active .relative { transition: transform 0.2s ease; }
.modal-enter-from .relative, .modal-leave-to .relative { transform: scale(0.95); }
</style>
