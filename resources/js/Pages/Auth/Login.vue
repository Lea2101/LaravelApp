<template>
    <Head title="Iniciar Sesión" />

    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <div class="w-full max-w-md p-6 bg-gray-800 shadow-md rounded-lg">
            <div class="mb-6 text-center">
                <AuthenticationCardLogo />
                <h2 class="text-2xl font-bold text-white">Iniciar Sesión</h2>
            </div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-400">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" class="text-white" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2 text-red-500" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" class="text-white" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2 text-red-500" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" class="text-white" />
                        <span class="ml-2 text-sm text-gray-400">Recuerdame</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-400 hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        ¿Olvidaste tu contraseña?
                    </Link>

                    <Link
                        
                        :href="route('register')"
                        class="rounded-md px-3 py-2 text-gray-300 ring-1 ring-transparent transition hover:text-gray-100 focus:outline-none focus-visible:ring-indigo-500"
                    >
                        Registrarse
                    </Link>
                </div>

                <div class="mt-6">
                    <PrimaryButton
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Iniciar sesión
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    canRegister: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
