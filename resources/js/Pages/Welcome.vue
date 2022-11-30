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
        class="relative flex flex-col space-y-8 justify-center items-start min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
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
                <Link :href="route('languages.create')">Create language</Link>
                <Link :href="route('languages.edit', { language: 1 })"
                    >Update language 1</Link
                >
                <Link
                    :href="route('languages.destroy', { language: 1 })"
                    as="button"
                    method="delete"
                    >Delete language 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('settings.create')">Create setting</Link>
                <Link :href="route('settings.show', { setting: 1 })"
                    >Show setting 1</Link
                >
                <Link :href="route('settings.edit', { setting: 1 })"
                    >Update setting 1</Link
                >
                <Link
                    :href="route('settings.destroy', { setting: 1 })"
                    as="button"
                    method="delete"
                    >Delete setting 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('comments.create')">Create comment</Link>
                <Link :href="route('comments.show', { comment: 1 })"
                    >Show comment 1</Link
                >
                <Link :href="route('comments.edit', { comment: 1 })"
                    >Update comment 1</Link
                >
                <Link
                    :href="route('comments.destroy', { comment: 1 })"
                    as="button"
                    method="delete"
                    >Delete comment 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('categories.create')">Create category</Link>
                <Link :href="route('categories.edit', { category: 1 })"
                    >Update category 1</Link
                >
                <Link
                    :href="route('categories.destroy', { category: 1 })"
                    as="button"
                    method="delete"
                    >Delete category 1</Link
                >
                <Link :href="route('categories.show', { category: 1 })"
                    >Show category 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('tags.create')">Create tag</Link>
                <Link :href="route('tags.edit', { tag: 1 })">Update tag 1</Link>
                <Link
                    :href="route('tags.destroy', { tag: 1 })"
                    as="button"
                    method="delete"
                    >Delete tag 1</Link
                >
                <Link :href="route('tags.show', { tag: 1 })">Show tag 1</Link>
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
                <Link
                    :href="route('assets.destroy', { asset: 1 })"
                    as="button"
                    method="delete"
                    >Delete asset 1</Link
                >
            </div>

            <template v-else>
                <Link :href="route('login')">Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    >Register</Link
                >

                <Link :href="route('comments.create')">Create comment</Link>
            </template>
        </div>
        <div v-if="canLogin" class="flex flex-row space-x-8">
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('ui_messages.create')"
                    >Create ui message</Link
                >
                <Link :href="route('ui_messages.edit', { uIMessage: 1 })"
                    >Update ui message 1</Link
                >
                <Link
                    :href="route('ui_messages.destroy', { uIMessage: 1 })"
                    as="button"
                    method="delete"
                    >Delete ui message 1</Link
                >
            </div>
            <div class="flex flex-col" v-if="$page.props.auth.user">
                <Link :href="route('newsletters.create')"
                    >Create newsletter</Link
                >
                <Link :href="route('newsletters.edit', { newsletter: 1 })"
                    >Update newsletter 1</Link
                >
                <Link
                    :href="route('newsletters.destroy', { newsletter: 1 })"
                    as="button"
                    method="delete"
                    >Delete newsletter 1</Link
                >
            </div>
        </div>
    </div>
</template>
