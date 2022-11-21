<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div v-if="canLogin" class="flex flex-row space-x-8">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                >Dashboard</Link
            >
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('articles.create')">Create Article</Link>
                <Link :href="route('articles.show', { article: 1 })"
                    >Show Article 1</Link
                >
                <Link :href="route('articles.edit', { article: 1 })"
                    >Update Article 1</Link
                >
                <Link
                    :href="route('articles.destroy', { article: 1 })"
                    as="button"
                    method="delete"
                    >Delete Article 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link v-if="$page.props.auth.user" :href="route('roles.create')"
                    >Create Role</Link
                >
                <Link :href="route('roles.show', { role: 1 })"
                    >Show role 1</Link
                >
                <Link :href="route('roles.edit', { role: 1 })"
                    >Update role 1</Link
                >
                <Link
                    :href="route('roles.destroy', { role: 1 })"
                    as="button"
                    method="delete"
                    >Delete role 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('permission.role.create')"
                    >Create permission role</Link
                >
                <Link
                    :href="
                        route('permission.role.destroy', { permission_role: 1 })
                    "
                    as="button"
                    method="delete"
                    >Delete permission role 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('assets.create')">Import asset</Link>
                <Link :href="route('assets.edit', { asset: 1 })"
                    >Update asset 1</Link
                >
            </div>

            <template v-else>
                <Link :href="route('login')">Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    >Register</Link
                >
            </template>
        </div>
    </div>
</template>
