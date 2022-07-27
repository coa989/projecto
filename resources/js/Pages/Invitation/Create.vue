<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';
    import {defineProps} from "@vue/runtime-core";

    // const props = defineProps({
    //     user: Object
    // })

    const form = useForm({
        first_name: '',
        last_name: '',
        email: '',
        role: '',
    });

    const submit = () => {
        form.post(route('invitations.store', {
            'workspace': usePage().props.value.auth.user.workspace_id
        }));
    };
</script>

<template>
    <Head title="Invite People"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invite People to your Projecto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>WHO DO TOU WANT TO INVITE?</h2>
                        <form @submit.prevent="submit">
                            <div class="mb-2">
                                <label for="first_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                                <span class="font-medium text-sm text-gray-700">First Name</span>
                                <input v-model="form.first_name" type="text" id="first_name"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-5/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                       required>
                            </div>
                            <div class="mb-2">
                                <label for="last_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                                <span class="font-medium text-sm text-gray-700">Last Name</span>
                                <input v-model="form.last_name" type="text" id="last_name"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-5/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                       required>
                            </div>
                            <div class="mb-2">
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                                <span class="font-medium text-sm text-gray-700">Email</span>
                                <input v-model="form.email" type="email" id="email"
                                       class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-5/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                       required>
                            </div>
                            <h2 class="mt-6">WHAT WILL BE HIS/HER ROLE IN THE SYSTEM?</h2>

                            <fieldset class="mt-6">
                                <div class="flex items-center mb-4">
                                    <input v-model="form.role" id="owner" type="radio"
                                           value="owner"
                                           class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="owner"
                                           class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Owner
                                    </label>
                                </div>

                                <div class="flex items-center mb-4">
                                    <input v-model="form.role" id="member" type="radio"
                                           value="member"
                                           class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="member"
                                           class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Member
                                    </label>
                                </div>

                                <div class="flex items-center mb-4">
                                    <input v-model="form.role" id="client" type="radio" value="client"
                                           class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="client"
                                           class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Client
                                    </label>
                                </div>
                            </fieldset>

                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Send Invitation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
