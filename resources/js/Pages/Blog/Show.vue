<template>
  <Head>
    <title>{{ locale === 'fr' ? post.title_fr : post.title_en }}</title>
    <meta name="description" :content="locale === 'fr' ? post.meta_description_fr : post.meta_description_en" />
    <meta property="og:title" :content="locale === 'fr' ? (post.meta_title_fr || post.title_fr) : (post.meta_title_en || post.title_en)" />
    <meta property="og:description" :content="locale === 'fr' ? post.meta_description_fr : post.meta_description_en" />
    <meta property="og:type" content="article" />
    <meta property="og:url" :content="currentUrl" />
    <meta v-if="post.og_image || post.cover_image" property="og:image" :content="ogImageUrl" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="locale === 'fr' ? post.title_fr : post.title_en" />
    <meta name="twitter:description" :content="locale === 'fr' ? post.meta_description_fr : post.meta_description_en" />
    <meta v-if="post.og_image || post.cover_image" name="twitter:image" :content="ogImageUrl" />
    <link rel="canonical" :href="currentUrl" />
  </Head>

  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-[#0f3d2e]/95 backdrop-blur shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <Link href="/" class="flex items-center gap-2 font-bold text-xl text-white">
            <div class="w-9 h-9 rounded-xl bg-teal-500 flex items-center justify-center text-white font-bold text-base">
              {{ profile?.name?.charAt(0) || 'P' }}
            </div>
            <span>{{ profile?.name?.split(' ')[0] || 'Portfolio' }}</span>
          </Link>
          <div class="flex items-center gap-4">
            <Link href="/blog" class="text-sm text-white/80 hover:text-white transition-colors font-medium">
              ← Blog
            </Link>
            <button
              @click="setLocale(locale === 'fr' ? 'en' : 'fr')"
              class="px-3 py-1.5 text-sm font-semibold rounded-lg border border-white/40 text-white hover:bg-white/10 transition-colors"
            >{{ locale === 'fr' ? 'EN' : 'FR' }}</button>
          </div>
        </div>
      </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-12">
      <!-- Cover image -->
      <div v-if="post.cover_image" class="rounded-2xl overflow-hidden mb-8 aspect-video">
        <img :src="'/storage/' + post.cover_image" :alt="locale === 'fr' ? post.title_fr : post.title_en" class="w-full h-full object-cover" />
      </div>

      <article>
        <!-- Meta info -->
        <div class="flex flex-wrap items-center gap-3 mb-4">
          <span
            v-for="cat in post.categories"
            :key="cat.id"
            class="px-3 py-1 text-sm font-semibold rounded-full"
            :style="{ backgroundColor: (cat.color || '#3B82F6') + '20', color: cat.color || '#3B82F6' }"
          >{{ locale === 'fr' ? cat.name_fr : cat.name_en }}</span>
        </div>

        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">
          {{ locale === 'fr' ? post.title_fr : post.title_en }}
        </h1>

        <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-400">
          <span v-if="post.published_at">{{ formatDate(post.published_at) }}</span>
          <span class="flex items-center gap-1">
            <span>🕐</span>
            {{ post.reading_time }} min {{ locale === 'fr' ? 'de lecture' : 'read' }}
          </span>
          <span class="flex items-center gap-1">
            <span>👁️</span>
            {{ post.views }} {{ locale === 'fr' ? 'vues' : 'views' }}
          </span>
        </div>

        <!-- Tags -->
        <div v-if="post.tags.length > 0" class="flex flex-wrap gap-2 mt-4">
          <Link
            v-for="tag in post.tags"
            :key="tag.id"
            :href="'/blog?tag=' + tag.slug"
            class="px-2 py-0.5 bg-gray-100 text-gray-500 hover:text-teal-600 rounded text-xs transition-colors"
          >#{{ tag.name }}</Link>
        </div>

        <!-- Social share -->
        <div class="flex items-center gap-3 mt-6 pt-6 border-t border-gray-100">
          <span class="text-sm font-semibold text-gray-700">{{ locale === 'fr' ? 'Partager :' : 'Share:' }}</span>
          <a :href="twitterShareUrl" target="_blank" rel="noopener noreferrer"
            class="flex items-center gap-1.5 px-3 py-1.5 bg-black text-white text-sm rounded-lg hover:bg-gray-800 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.259 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            X
          </a>
          <a :href="linkedinShareUrl" target="_blank" rel="noopener noreferrer"
            class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            LinkedIn
          </a>
          <a :href="facebookShareUrl" target="_blank" rel="noopener noreferrer"
            class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            Facebook
          </a>
          <button @click="copyLink" class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition-colors">
            <span>{{ copied ? '✅' : '🔗' }}</span>
            {{ copied ? (locale === 'fr' ? 'Copié !' : 'Copied!') : (locale === 'fr' ? 'Copier le lien' : 'Copy link') }}
          </button>
        </div>

        <!-- Content -->
        <div
          class="prose prose-lg max-w-none mt-10 text-gray-700 prose-headings:text-gray-900 prose-a:text-teal-600 prose-code:bg-gray-100 prose-code:px-1 prose-code:rounded prose-pre:bg-gray-900"
          v-html="locale === 'fr' ? post.content_fr : post.content_en"
        />
      </article>

      <!-- Recommended posts -->
      <section v-if="recommended.length > 0" class="mt-16 pt-10 border-t border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
          {{ locale === 'fr' ? 'Articles similaires' : 'Similar articles' }}
        </h2>
        <div class="grid sm:grid-cols-3 gap-6">
          <Link
            v-for="rec in recommended"
            :key="rec.id"
            :href="'/blog/' + rec.slug"
            class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden"
          >
            <div class="aspect-video bg-gray-100 overflow-hidden">
              <img
                v-if="rec.cover_image"
                :src="'/storage/' + rec.cover_image"
                :alt="locale === 'fr' ? rec.title_fr : rec.title_en"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
              />
              <div v-else class="w-full h-full flex items-center justify-center text-3xl text-gray-300">📄</div>
            </div>
            <div class="p-4">
              <h3 class="font-semibold text-gray-900 group-hover:text-teal-600 transition-colors line-clamp-2">
                {{ locale === 'fr' ? rec.title_fr : rec.title_en }}
              </h3>
              <p class="mt-1 text-sm text-gray-400">{{ rec.reading_time }} min {{ locale === 'fr' ? 'de lecture' : 'read' }}</p>
            </div>
          </Link>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3'

const props = defineProps({
  post: Object,
  recommended: Array,
})

const page = usePage()
const locale = computed(() => page.props.locale || 'fr')
const profile = computed(() => page.props.profile)
const currentUrl = computed(() => window.location.href)

const ogImageUrl = computed(() => {
  const img = props.post.og_image || props.post.cover_image
  return img ? window.location.origin + '/storage/' + img : ''
})

const twitterShareUrl = computed(() =>
  `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentUrl.value)}&text=${encodeURIComponent(locale.value === 'fr' ? props.post.title_fr : props.post.title_en)}`
)
const linkedinShareUrl = computed(() =>
  `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(currentUrl.value)}`
)
const facebookShareUrl = computed(() =>
  `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl.value)}`
)

const copied = ref(false)
const copyLink = async () => {
  await navigator.clipboard.writeText(currentUrl.value)
  copied.value = true
  setTimeout(() => { copied.value = false }, 2000)
}

const setLocale = (lang) => router.post('/locale', { locale: lang }, { preserveScroll: true })

const formatDate = (dateStr) => {
  if (!dateStr) return ''
  return new Date(dateStr).toLocaleDateString(locale.value === 'fr' ? 'fr-FR' : 'en-US', {
    year: 'numeric', month: 'long', day: 'numeric',
  })
}
</script>
