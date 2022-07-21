<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import {Head, useForm} from '@inertiajs/inertia-vue3';
    import {defineProps} from "@vue/runtime-core";

    const props = defineProps({
        user: Object
    })

    const form = useForm({
        first_name: props.user.first_name,
        last_name: props.user.last_name,
        email: props.user.email,
        avatar: null
    });

    const submit = () => {
        form.post(route('user.update', {
            'user': props.user.id
        }));
    };
</script>

<template>
    <Head title="Edit Account"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-6 flex">
                                <img v-if="user.avatar_path"
                                     class="w-12 h-12 rounded-full"
                                     :src="'../storage/'+user.avatar_path"
                                     alt="Rounded avatar">
                                <img v-else
                                     class="w-12 h-12 rounded-full"
                                     src="https://toppng.com/uploads/preview/roger-berry-avatar-placeholder-11562991561rbrfzlng6h.png"
                                     alt="roger berry - avatar placeholder PNG image with transparent background@toppng.com">
                                <div class="ml-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                           for="user_avatar">Profile Photo</label>
                                    <input
                                        @input="form.avatar = $event.target.files[0]"
                                        class="block text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="first_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First
                                    Name</label>
                                <input type="text" id="first_name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       v-model="form.first_name"
                                       required>
                            </div>
                            <div class="mb-6">
                                <label for="last_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last
                                    Name</label>
                                <input type="text" id="last_name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       v-model="form.last_name"
                                       required>
                            </div>
                            <div class="mb-6">
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="email" id="email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       v-model="form.email"
                                       required>
                            </div>
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
