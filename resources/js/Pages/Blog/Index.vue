<template>
  <Head>
    <title>Blog — {{ profile?.name || 'Portfolio' }}</title>
    <meta name="description" :content="locale === 'fr' ? 'Articles et réflexions sur le développement web, la tech et plus encore.' : 'Articles and thoughts on web development, tech and more.'" />
    <meta property="og:title" :content="'Blog — ' + (profile?.name || 'Portfolio')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" :content="currentUrl" />
  </Head>

  <div class="min-h-screen bg-gray-50">
    <PublicNavbar :current-locale="locale" active-page="blog" @toggle-locale="toggleLocale" />

    <main class="max-w-6xl mx-auto px-4 py-12">
      <!-- Page title -->
      <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-900">Blog</h1>
        <p class="mt-2 text-gray-500">
          {{ locale === 'fr' ? 'Articles et réflexions sur le développement web' : 'Articles and thoughts on web development' }}
        </p>
      </div>

      <div class="flex flex-col lg:flex-row gap-10">
        <!-- Posts grid -->
        <section class="flex-1">
          <!-- Active filter badge -->
          <div v-if="filters.category || filters.tag" class="mb-6 flex items-center gap-2">
            <span class="text-sm text-gray-500">{{ locale === 'fr' ? 'Filtre actif :' : 'Active filter:' }}</span>
            <Link href="/blog" class="flex items-center gap-1 px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-sm font-medium hover:bg-teal-200 transition-colors">
              {{ filters.category || filters.tag }}
              <span class="ml-1">✕</span>
            </Link>
          </div>

          <!-- Empty state -->
          <div v-if="posts.data.length === 0" class="text-center py-20 text-gray-400">
            <span class="text-5xl block mb-4">📝</span>
            <p class="font-medium">{{ locale === 'fr' ? "Aucun article pour l'instant" : 'No articles yet' }}</p>
          </div>

          <!-- Grid -->
          <div v-else class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <Link
              v-for="post in posts.data"
              :key="post.id"
              :href="'/blog/' + post.slug"
              class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col"
            >
              <div class="aspect-video bg-gray-100 overflow-hidden">
                <img
                  :src="post.cover_image ? '/storage/' + post.cover_image : '/images/defaultbloc.jpg'"
                  :alt="locale === 'fr' ? post.title_fr : post.title_en"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                />
              </div>
              <div class="p-5 flex flex-col flex-1">
                <!-- Categories -->
                <div class="flex flex-wrap gap-1 mb-3">
                  <span
                    v-for="cat in post.categories"
                    :key="cat.id"
                    class="px-2 py-0.5 text-xs font-semibold rounded-full"
                    :style="{ backgroundColor: (cat.color || '#3B82F6') + '20', color: cat.color || '#3B82F6' }"
                  >{{ locale === 'fr' ? cat.name_fr : cat.name_en }}</span>
                </div>

                <h2 class="font-bold text-gray-900 group-hover:text-teal-600 transition-colors line-clamp-2">
                  {{ locale === 'fr' ? post.title_fr : post.title_en }}
                </h2>

                <p class="mt-2 text-gray-500 text-sm line-clamp-3 flex-1">
                  {{ locale === 'fr' ? post.excerpt_fr : post.excerpt_en }}
                </p>

                <div class="mt-4 flex items-center justify-between text-xs text-gray-400">
                  <span>{{ formatDate(post.published_at) }}</span>
                  <span>{{ post.reading_time }} min {{ locale === 'fr' ? 'de lecture' : 'read' }}</span>
                </div>
              </div>
            </Link>
          </div>

          <!-- Pagination -->
          <div v-if="posts.last_page > 1" class="mt-10 flex justify-center gap-2">
            <Link
              v-for="link in posts.links"
              :key="link.label"
              :href="link.url || '#'"
              :class="[
                'px-4 py-2 rounded-lg text-sm font-medium transition-colors',
                link.active ? 'bg-teal-600 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50',
                !link.url ? 'opacity-40 pointer-events-none' : ''
              ]"
              v-html="link.label"
            />
          </div>
        </section>

        <!-- Sidebar -->
        <aside class="lg:w-64 shrink-0 space-y-8">
          <!-- Categories -->
          <div v-if="categories.length > 0">
            <h3 class="font-bold text-gray-900 mb-3">{{ locale === 'fr' ? 'Catégories' : 'Categories' }}</h3>
            <div class="space-y-1">
              <Link
                v-for="cat in categories"
                :key="cat.id"
                :href="'/blog?category=' + cat.slug"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white transition-colors text-sm"
                :class="filters.category === cat.slug ? 'bg-white font-semibold text-teal-600 shadow-sm' : 'text-gray-600'"
              >
                <span class="w-2 h-2 rounded-full shrink-0" :style="{ backgroundColor: cat.color || '#3B82F6' }"></span>
                {{ locale === 'fr' ? cat.name_fr : cat.name_en }}
              </Link>
            </div>
          </div>

          <!-- Tags -->
          <div v-if="tags.length > 0">
            <h3 class="font-bold text-gray-900 mb-3">Tags</h3>
            <div class="flex flex-wrap gap-2">
              <Link
                v-for="tag in tags"
                :key="tag.id"
                :href="'/blog?tag=' + tag.slug"
                class="px-3 py-1 rounded-full text-sm transition-colors"
                :class="filters.tag === tag.slug ? 'bg-teal-600 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-teal-400 hover:text-teal-600'"
              >
                #{{ tag.name }}
              </Link>
            </div>
          </div>
        </aside>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import PublicNavbar from '@/Components/PublicNavbar.vue'

const props = defineProps({
  posts: Object,
  categories: Array,
  tags: Array,
  filters: Object,
})

const page = usePage()
const profile = computed(() => page.props.profile)
const currentUrl = computed(() => window.location.href)

const locale = ref(page.props.locale || 'fr')
const toggleLocale = () => { locale.value = locale.value === 'fr' ? 'en' : 'fr' }

const formatDate = (dateStr) => {
  if (!dateStr) return ''
  return new Date(dateStr).toLocaleDateString(locale.value === 'fr' ? 'fr-FR' : 'en-US', {
    year: 'numeric', month: 'long', day: 'numeric',
  })
}
</script>
