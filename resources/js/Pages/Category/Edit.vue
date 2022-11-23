<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
import Checkbox from '@/Components/Checkbox.vue'

const props = defineProps({
    category: Object,
    categories: Object,
})

const form = useForm({
    parent_id: props.category.parent_id,
    title: props.category.title,
    slug: props.category.slug,
    description: props.category.description,
    published: props.category.published,
})

const submit = () => {
    form.put(
        route('categories.update', {
            category: props.category.id,
        })
    )
}
</script>

<template>
    <GuestLayout>
        <Head title="Update an category" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="parent" value="Parent category" />
                <select
                    id="parent"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.parent_id"
                >
                    <option :value="null" selected>
                        --- Select an option ---
                    </option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                        v-text="category.title"
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
                <InputLabel for="description" value="Description" />
                <textarea
                    id="description"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.description"
                ></textarea>
                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="mt-4">
                <InputLabel for="published" value="Publish" />
                <Checkbox
                    id="published"
                    v-model="form.published"
                    :checked="form.published==1"
                />
                <InputError class="mt-2" :message="form.errors.published" />
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
