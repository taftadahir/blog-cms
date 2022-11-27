<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
import Checkbox from '@/Components/Checkbox.vue'

const props = defineProps({
    language: Object,
})

const form = useForm({
    title: props.language.title,
    iso_code: props.language.iso_code,
    active: props.language.active == 1,
})

const submit = () => {
    form.put(
        route('languages.update', {
            language: props.language.id,
        })
    )
}
</script>

<template>
    <GuestLayout>
        <Head title="Update an language" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="title" value="Title" />
                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <InputLabel for="iso_code" value="ISO code" />
                <TextInput
                    id="iso_code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.iso_code"
                />
                <InputError class="mt-2" :message="form.errors.iso_code" />
            </div>

            <div class="mt-4">
                <InputLabel for="active" value="Active" />
                <Checkbox
                    id="active"
                    v-model="form.active"
                    :checked="form.active"
                />
                <InputError class="mt-2" :message="form.errors.active" />
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
