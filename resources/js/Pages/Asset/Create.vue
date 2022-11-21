<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'
const form = useForm({ asset: null })
const submit = () => {
    form.post(route('assets.store'), {})
}
</script>

<template>
    <GuestLayout>
        <Head title="Import asset" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="asset" value="Import asset" />
                <input
                    id="asset"
                    type="file"
                    class="mt-1 block w-full"
                    @input="form.asset = $event.target.files[0]"
                />
                <InputError class="mt-2" :message="form.errors.asset" />
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
