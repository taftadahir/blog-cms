<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
import Checkbox from '@/Components/Checkbox.vue'
import { watch } from 'vue'
const props = defineProps({
    statuses: Object,
    articles: Object,
    contentTypes: Object,
})
const form = useForm({
    new_sys_id: true,
    same_article_as: null,
    parent_id: null,
    title: 'Default title',
    slug: 'Default slug',
    content: 'Default content',
    content_type: 'html',
    excerpt: 'Default excerpt',
    keywords: 'Default keywords',
    status: 'draft',
    disable_comment: true,
    disable_approval: true,
    read_time: null,
    password: '',
    version: 0,
})
watch(
    () => form.new_sys_id,
    (newValue, _) => {
        if (newValue) {
            form.same_article_as = null
        }
    }
)
watch(
    () => form.same_article_as,
    (newValue, _) => {
        if (newValue) {
            form.new_sys_id = false
        }
    }
)
const submit = () => {
    form.post(route('articles.store'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Create an article" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="new_sys_id" value="Create a new sys id" />
                <Checkbox
                    id="new_sys_id"
                    v-model="form.new_sys_id"
                    :checked="form.new_sys_id"
                />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="same_article_as"
                    value="Sys ID same article as"
                />
                <select
                    id="same_article_as"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.same_article_as"
                    :disabled="form.new_sys_id"
                >
                    <option :value="null" selected>
                        --- Select an option ---
                    </option>
                    <option
                        v-for="article in articles"
                        :key="article.id"
                        :value="article.id"
                        v-text="article.title"
                    />
                </select>
                <InputError
                    class="mt-2"
                    :message="form.errors.same_article_as"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="parent" value="Parent" />
                <select
                    id="parent"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.parent_id"
                >
                    <option :value="null" selected>
                        --- Select an option ---
                    </option>
                    <option
                        v-for="article in articles"
                        :key="article.id"
                        :value="article.id"
                        v-text="article.title"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.parent_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="title" value="Title" />
                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="title"
                />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <InputLabel for="slug" value="Slug" />
                <TextInput
                    id="slug"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.slug"
                    required
                />
                <InputError class="mt-2" :message="form.errors.slug" />
            </div>

            <div class="mt-4">
                <InputLabel for="content" value="Content" />
                <textarea
                    id="content"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.content"
                ></textarea>
                <InputError class="mt-2" :message="form.errors.content" />
            </div>

            <div class="mt-4">
                <InputLabel for="content_type" value="Content type" />
                <select
                    id="content_type"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.content_type"
                >
                    <option :value="null" selected>
                        --- Select an option ---
                    </option>
                    <option
                        v-for="(value, key) in contentTypes"
                        :key="key"
                        :value="key"
                        v-text="value"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.content_type" />
            </div>

            <div class="mt-4">
                <InputLabel for="excerpt" value="Excerpt" />
                <textarea
                    id="excerpt"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.excerpt"
                ></textarea>
                <InputError class="mt-2" :message="form.errors.excerpt" />
            </div>

            <div class="mt-4">
                <InputLabel for="keywords" value="Keywords" />
                <textarea
                    id="keywords"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.keywords"
                ></textarea>
                <InputError class="mt-2" :message="form.errors.keywords" />
            </div>

            <div class="mt-4">
                <InputLabel for="status" value="Status" />
                <select
                    id="status"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.status"
                >
                    <option :value="null" selected>
                        --- Select an option ---
                    </option>
                    <option
                        v-for="(value, key) in statuses"
                        :key="key"
                        :value="key"
                        v-text="value"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.status" />
            </div>

            <div class="mt-4">
                <InputLabel for="disable_comment" value="Disable comment" />
                <Checkbox
                    id="disable_comment"
                    v-model="form.disable_comment"
                    :checked="form.disable_comment"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.disable_comment"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="disable_approval" value="Disable approval" />
                <Checkbox
                    id="disable_approval"
                    v-model="form.disable_approval"
                    :checked="form.disable_approval"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.disable_approval"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="read_time" value="Read time (min)" />
                <TextInput
                    id="read_time"
					type="number"
					max='255'
                    class="mt-1 block w-full"
                    v-model="form.read_time"
                />
                <InputError class="mt-2" :message="form.errors.read_time" />
            </div>

            <div class="mt-4">
                <InputLabel for="version" value="Version" />
                <TextInput
                    id="version"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.version"
                />
                <InputError class="mt-2" :message="form.errors.version" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Save
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
