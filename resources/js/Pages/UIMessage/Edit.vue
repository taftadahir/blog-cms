<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
const props = defineProps({
    languages: Object,
    uIMessage: Object,
})

const form = useForm({
    lang: props.uIMessage.language_id,
    code: props.uIMessage.code,
    value: props.uIMessage.value,
    description: props.uIMessage.description,
})

const submit = () => {
    form.put(
        route('ui_messages.update', {
            uIMessage: props.uIMessage.id,
        })
    )
}
</script>

<template>
    <GuestLayout>
        <Head title="Update an ui message" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="language" value="Language" />
                <select
                    id="language"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.lang"
                >
                    <option :value="null" selected>
                        --- Select an option ---
                    </option>
                    <option
                        v-for="lang in languages"
                        :key="lang.id"
                        :value="lang.id"
                        v-text="lang.title"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.lang" />
            </div>

            <div class="mt-4">
                <InputLabel for="code" value="Code" />
                <TextInput
                    id="code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.code"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.code" />
            </div>

            <div class="mt-4">
                <InputLabel for="value" value="Value" />
                <TextInput
                    id="value"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.value"
                />
                <InputError class="mt-2" :message="form.errors.value" />

                <div class="mt-4">
                    <InputLabel for="description" value="Description" />
                    <textarea
                        id="description"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        v-model="form.description"
                    ></textarea>
                    <InputError
                        class="mt-2"
                        :message="form.errors.description"
                    />
                </div>
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
