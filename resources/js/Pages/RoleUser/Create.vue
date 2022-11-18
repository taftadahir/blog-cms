<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    roles: Object,
    users: Object,
})

const form = useForm({
    role_id: null,
    user_id: null,
})
const submit = () => {
    form.post(route('role.user.store'), {})
}
</script>

<template>
    <GuestLayout>
        <Head title="Create role user" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="role" value="Role" />
                <select
                    id="role"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.role_id"
					required
                >
                    <option
                        v-for="role in roles"
                        :key="role.id"
                        :value="role.id"
                        v-text="role.title"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.role_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="user" value="User" />
                <select
                    id="user"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.user_id"
					required
                >
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

