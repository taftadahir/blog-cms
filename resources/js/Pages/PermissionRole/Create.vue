<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    roles: Object,
    permissions: Object,
})

const form = useForm({
    role_id: null,
    permission_id: null,
})
const submit = () => {
    form.post(route('permission.role.store'), {})
}
</script>

<template>
    <GuestLayout>
        <Head title="Create permission role" />

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
                <InputLabel for="permission" value="Permission" />
                <select
                    id="permission"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.permission_id"
					required
                >
                    <option
                        v-for="permission in permissions"
                        :key="permission.id"
                        :value="permission.id"
                        v-text="permission.title"
                    />
                </select>
                <InputError class="mt-2" :message="form.errors.permission_id" />
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
