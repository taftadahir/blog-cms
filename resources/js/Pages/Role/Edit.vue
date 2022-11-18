<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
const props = defineProps({
    role: Object,
})

const form = useForm({
    title: props.role.title,
    code: props.role.code,
    description: props.role.description,
})
const submit = () => {
    form.put(
        route('roles.update', {
            role: props.role.id,
        })
    )
}
</script>

<template>
    <GuestLayout>
        <Head title="Update role" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="title" value="Title" />
                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    autofocus
                    autocomplete="title"
                />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <InputLabel for="code" value="Code" />
                <TextInput
                    id="code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.code"
                />
                <InputError class="mt-2" :message="form.errors.code" />
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
