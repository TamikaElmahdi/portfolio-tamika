<template>
  <AdminLayout title="Messages" subtitle="Messages reçus via le formulaire de contact">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div v-if="messages.length === 0" class="p-12 text-center text-gray-500">
        <span class="text-5xl block mb-4">✉️</span>
        <p class="font-medium">Aucun message pour l'instant</p>
      </div>
      <div v-else class="divide-y divide-gray-100">
        <Link
          v-for="msg in messages"
          :key="msg.id"
          :href="'/admin/messages/' + msg.id"
          class="flex items-start gap-4 p-5 hover:bg-gray-50 transition-colors"
          :class="!msg.read_at ? 'bg-teal-50/50' : ''"
        >
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-500 to-teal-700 flex items-center justify-center text-white font-bold flex-shrink-0">
            {{ msg.name?.charAt(0).toUpperCase() }}
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between gap-2">
              <span class="font-bold text-gray-900 flex items-center gap-2">
                {{ msg.name }}
                <span v-if="!msg.read_at" class="w-2 h-2 rounded-full bg-teal-500"></span>
              </span>
              <span class="text-xs text-gray-400 flex-shrink-0">{{ formatDate(msg.created_at) }}</span>
            </div>
            <div class="text-sm font-medium text-gray-700 mt-0.5">{{ msg.subject }}</div>
            <div class="text-sm text-gray-500 mt-1 truncate">{{ msg.message?.substring(0, 80) }}...</div>
          </div>
        </Link>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineProps({ messages: Array })
const formatDate = (d) => new Date(d).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' })
</script>
