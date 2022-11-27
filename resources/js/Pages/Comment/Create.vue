<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
const props = defineProps({
    articles: Object,
    comments: Object,
})
const form = useForm({
    article_id: null,
    parent_id: null,
    name: 'Subscriber',
    email: 'subscriber@blog.com',
    content: 'Default content',
})
const submit = () => {
    form.post(route('comments.store'))
}
</script>

<template>
    <GuestLayout>
        <Head title="Create a comment" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="article" value="Article" />
                <select
                    id="article"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.article_id"
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
                <InputError class="mt-2" :message="form.errors.article_id" />
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
                        v-for="comment in comments"
                        :key="comments"
                        :value="comment.id"
                        v-text="comment.content"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.parent_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                />
                    <!-- required -->
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                />
                <InputError class="mt-2" :message="form.errors.email" />
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
