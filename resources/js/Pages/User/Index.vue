<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import {Head} from '@inertiajs/inertia-vue3';
    import {defineProps} from "@vue/runtime-core";
    import {Link} from '@inertiajs/inertia-vue3';

    const props = defineProps({
        users: Object,
        pendingUsers: Object
    })
</script>

<template>
    <Head title="People"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                    People
                </h2>
                <Link v-if="$page.props.auth.user.workspace_role_id===1" :href="route('invitations', {
                    'workspace': $page.props.auth.user.workspace_id
                })"
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    + Invite People
                </Link>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <h5 class="text-center my-3">Active Members</h5>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            </thead>
                            <tbody>
                            <tr v-for="user in users"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img v-if="user.avatar_path"
                                         class="w-12 h-12 rounded-full"
                                         :src="'../storage/'+user.avatar_path"
                                         alt="Rounded avatar">
                                    <img v-else
                                         class="w-12 h-12 rounded-full"
                                         :src="'https://eu.ui-avatars.com/api/?name='+user.first_name+'+'+user.last_name">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{user.first_name + ' ' +
                                            user.last_name}}
                                        </div>
                                    </div>
                                </th>
                                <td class="py-4 px-6">
                                    {{user.email}}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        {{user.role}}

                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h5 class="text-center my-3">Pending Invitations</h5>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            </thead>
                            <tbody>
                            <tr v-for="pendingUser in pendingUsers"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img
                                        class="w-12 h-12 rounded-full"
                                        :src="'https://eu.ui-avatars.com/api/?name='+pendingUser.email">
                                    <div class="pl-3">
<!--                                        <div class="text-base font-thin"> Invited by {{pendingUser.invitedByFirstName+' '+pendingUser.invitedByLastName}} {{pendingUser.invitedAt}}, not logged in yet.-->
<!--                                            <Link>Resend invitation mail</Link>-->
<!--                                        </div>-->
                                    </div>
                                </th>
                                <td class="py-4 px-6">
                                    Invited by {{pendingUser.invitedByFirstName+' '+pendingUser.invitedByLastName}} {{pendingUser.invitedAt}}, not logged in yet.
                                    <Link>Resend invitation mail</Link>
                                </td>
                                <td class="py-4 px-12">
                                    <div class="flex items-center">
                                        {{pendingUser.role}}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
