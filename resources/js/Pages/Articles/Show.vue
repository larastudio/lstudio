<script setup>

import AppLayout from '@/Layouts/FrontLayout.vue'
import Editor from '@tinymce/tinymce-vue'
import {useForm } from '@inertiajs/vue3'

const props =   defineProps({ 
    article: Object,
    AppLayout,
    'editor': Editor,
})

const form = useForm({
    body: props.article.body,
})

</script>
<template>
  <app-layout>
    <template #header>
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ article.title }}
         </h2>
         <div class="py-12">
             <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" v-html="article.body">
                 </div>
             </div>
         </div>
     </template>
  </app-layout>
</template>