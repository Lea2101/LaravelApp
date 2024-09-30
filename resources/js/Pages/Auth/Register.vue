<template>
    <Head title="Registrarse" />

    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <div class="w-full max-w-md p-6 bg-gray-800 shadow-md rounded-lg">
            <div class="mb-6 text-center">
                <AuthenticationCardLogo />
                <h2 class="text-2xl font-bold text-white">Crear una cuenta</h2>
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Nombre" class="text-white" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2 text-red-500" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" class="text-white" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                        autocomplete="username"
                    />
                    <InputError class="mt-2 text-red-500" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Contraseña" class="text-white" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2 text-red-500" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirmar contraseña" class="text-white" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2 text-red-500" :message="form.errors.password_confirmation" />
                </div>

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms" class="text-white">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required class="text-white" />
                            <div class="ml-2 text-sm text-gray-400">
                                Estoy de acuerdo con los
                                <a target="_blank" :href="route('terms.show')" class="underline text-gray-400 hover:text-gray-200">
                                    Términos de Servicio
                                </a>
                                y la
                                <a target="_blank" :href="route('policy.show')" class="underline text-gray-400 hover:text-gray-200">
                                    Política de Privacidad
                                </a>
                            </div>
                        </div>
                        <InputError class="mt-2 text-red-500" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <Link :href="route('login')" class="underline text-sm text-gray-400 hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        ¿Ya tienes una cuenta?
                    </Link>

                    <PrimaryButton
                        class="ml-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Registrarse
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

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
