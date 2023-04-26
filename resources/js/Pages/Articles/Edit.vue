<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import Editor from '@tinymce/tinymce-vue';
import {useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Import TinyMCE
import tinymce from 'tinymce/tinymce';

// Default icons are required for TinyMCE 5.3 or above
import 'tinymce/icons/default';

/* Required TinyMCE components */
import 'tinymce/themes/silver';
import 'tinymce/models/dom';

/* Import a skin (can be a custom skin instead of the default) */
import 'tinymce/skins/ui/oxide/skin.css';

// Any plugins you want to use has to be imported
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/image';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/media';

/* content UI CSS is required */
import contentUiSkinCss from 'tinymce/skins/ui/oxide/content.css?inline';

/* The default content CSS can be changed or replaced with appropriate CSS for the editor content. */
import contentCss from 'tinymce/skins/content/default/content.css?inline';


const props =  defineProps({ 
    article: Object,
    AppLayout,
    'editor': Editor,
})

const form = useForm({
    body: props.article.body,
})

const updateArticleBody = () => {
    form.put(route('articles.update', props.article), {
        errorBag: 'updateArticleBody',
        preserveScroll: true,
    });
};

const tinymeceConfig = {
    content_css: false, 
    skin: false,
    content_style: contentUiSkinCss.toString() + '\n' + contentCss.toString(),
    height: 500,
    menubar: false,
    plugins: [
        'link', 'lists','image', 'anchor', 'wordcount', 'media'
        ],
    toolbar:
    'undo redo | formatselect | bold italic backcolor | \
    alignleft aligncenter alignright alignjustify | \
    bullist numlist outdent indent | removeformat'
    }

</script>

<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article: {{article.title}}
            </h2>
        </template>

        <form @submit.prevent="updateArticleBody" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-4 overflow-hidden shadow-xl sm:rounded-lg">
                   <editor
                    :init="tinymeceConfig"
                    id="body"
                    v-model="form.body"
                    type="text"
                    />
                </div>
                <PrimaryButton class="mt-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
            </div>
        </form>
    </app-layout>
</template>

