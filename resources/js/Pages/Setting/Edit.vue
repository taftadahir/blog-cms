<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
const props = defineProps({
    setting: Object,
    users: Object,
})

const form = useForm({
    code: props.setting.code,
    value: props.setting.value,
    user_id: props.setting.user_id,
})

const submit = () => {
    form.put(
        route('settings.update', {
            setting: props.setting.id,
        })
    )
}
</script>

<template>
    <GuestLayout>
        <Head title="Update a setting" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="code" value="Code" />
                <TextInput
                    id="code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.code"
                    required
                    autofocus
                    autocomplete="code"
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
            </div>

            <div class="mt-4">
                <InputLabel for="user_id" value="User" />
                <select
                    id="user_id"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.user_id"
                >
                    <option :value="null" selected>
                        --- Select an option ---
                    </option>
                    <option
                        v-for="user in users"
                        :key="user.id"
                        :value="user.id"
                        v-text="user.name"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.user_id" />
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
