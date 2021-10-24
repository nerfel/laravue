<template>
    <div class="flex justify-center min-h-screen bg-gray-100">
        <div class="container mt-24 my-auto max-w-md border-2 border-gray-200 p-3 bg-white">
            <!-- header -->
            <div class="text-center my-6">
                <h1 class="text-3xl font-semibold text-gray-700">Sign up</h1>
                <p class="text-gray-500">Sign up new account</p>
            </div>
            <!-- sign-in -->
            <div class="m-6">
                <form class="mb-4" @submit.prevent="sendForm">
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Your name</label>
                        <input
                            name="name"
                            id="name"
                            placeholder="Enter your name"
                            class="w-full px-3 py-2 placeholder-gray-300 border rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"
                            :class="v$.form.name.$error ? 'border-red-400' : 'border-gray-300'"
                            v-model.trim="form.name"
                        />
                        <ul class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            <li
                                v-if="v$.form.$dirty && v$.form.name.required.$invalid"
                                class="invalid-feedback">
                                Required field
                            </li>
                            <li
                                v-if="v$.form.$dirty && v$.form.name.minNameLength.$invalid"
                                class="invalid-feedback">
                                The field must contain at least two characters
                            </li>
                        </ul>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email Address</label>
                        <input
                            name="email"
                            id="email"
                            placeholder="Your email address"
                            class="w-full px-3 py-2 placeholder-gray-300 border rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"
                            :class="v$.form.email.$error ? 'border-red-400' : 'border-gray-300'"
                            v-model.trim="form.email"
                        />
                        <ul class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            <li
                                v-if="v$.form.$dirty && v$.form.email.required.$invalid"
                                class="invalid-feedback">
                                Required field
                            </li>
                            <li
                                v-if="v$.form.$dirty && v$.form.email.email.$invalid"
                                class="invalid-feedback">
                                The field must contain a valid email
                            </li>
                            <li
                                v-if="v$.form.$dirty && v$.form.email.isUnique.$invalid"
                                class="invalid-feedback">
                                User with this email is already registered
                            </li>
                        </ul>
                    </div>
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Password</label>
                        </div>
                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="Your password"
                               class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"
                               :class="v$.form.password.$error ? 'border-red-400' : 'border-gray-300'"
                               v-model.trim="form.password"
                        />
                    </div>
                    <ul class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                        <li
                            v-if="v$.form.$dirty && v$.form.password.minLength.$invalid"
                            class="invalid-feedback">
                            Password must be at least 6 characters long
                        </li>
                    </ul>
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Confirm password</label>
                        </div>
                        <input type="password"
                               name="password"
                               id="confirm_password"
                               placeholder="Your password"
                               class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"
                               :class="v$.form.password_confirmation.$error ? 'border-red-400' : 'border-gray-300'"
                               v-model.trim="form.password_confirmation"
                        />
                        <ul class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            <li
                                v-if="v$.form.$dirty && v$.form.password_confirmation.required.$invalid"
                                class="invalid-feedback">
                                Required field
                            </li>
                            <li
                                v-if="v$.form.$dirty && v$.form.password_confirmation.sameAsPassword.$invalid"
                                class="invalid-feedback">
                                The field must match the password entered above
                            </li>
                        </ul>
                    </div>
                    <div class="mb-6">
                        <button
                            type="submit"
                            class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none duration-100 ease-in-out disabled:opacity-50"
                            :class="[{'disabled:opacity-50': pending || v$.form.$error}]"
                            :disabled="pending || v$.form.$error"
                        >
                            Sign up
                        </button>
                    </div>
                    <p class="text-sm text-center text-gray-400">
                        Already have an account?
                        <router-link to="/login" class="font-semibold text-indigo-500 focus:text-indigo-600 focus:outline-none focus:underline">Sign in</router-link>
                    </p>
                </form>
<!--                <div class="flex flex-row justify-center mb-8">-->
<!--                    <span class="absolute bg-white px-4 text-gray-500">or sign-in with</span>-->
<!--                    <div class="w-full bg-gray-200 mt-3 h-px"></div>-->
<!--                </div>-->
<!--                &lt;!&ndash; alternate sign-in &ndash;&gt;-->
<!--                <div class="flex flex-row gap-2">-->
<!--                    <button class="bg-green-500 text-white w-full p-2 flex flex-row justify-center gap-2 items-center rounded-sm hover:bg-green-600 duration-100 ease-in-out">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="w-5" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12c6.627 0 12-5.373 12-12S18.627 0 12 0zm.14 19.018c-3.868 0-7-3.14-7-7.018c0-3.878 3.132-7.018 7-7.018c1.89 0 3.47.697 4.682 1.829l-1.974 1.978v-.004c-.735-.702-1.667-1.062-2.708-1.062c-2.31 0-4.187 1.956-4.187 4.273c0 2.315 1.877 4.277 4.187 4.277c2.096 0 3.522-1.202 3.816-2.852H12.14v-2.737h6.585c.088.47.135.96.135 1.474c0 4.01-2.677 6.86-6.72 6.86z" fill="currentColor"/></g></svg>-->
<!--                        Google-->
<!--                    </button>-->
<!--                    <button class="bg-gray-700 text-white w-full p-2 flex flex-row justify-center gap-2 items-center rounded-sm hover:bg-gray-800 duration-100 ease-in-out">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="w-5" preserveAspectRatio="xMidYMid meet" viewBox="0 0 42.3 24"><g fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M36.4,15.3c1.4,1.4,2.9,2.7,4.1,4.2c0.6,0.7,1.1,1.4,1.5,2.1c0.6,1.1,0.1,2.3-0.9,2.4L35,24 c-1.6,0.1-2.9-0.5-3.9-1.6c-0.9-0.9-1.6-1.8-2.5-2.7c-0.3-0.4-0.7-0.7-1.1-1c-0.8-0.5-1.6-0.4-2.1,0.5c-0.5,0.9-0.6,1.9-0.6,2.9 c-0.1,1.5-0.5,1.8-2,1.9c-3.1,0.1-6.1-0.3-8.8-1.9c-2.4-1.4-4.3-3.3-5.9-5.6C4.9,12.2,2.4,7.5,0.2,2.6c-0.5-1.1-0.1-1.7,1.1-1.7 c2,0,4,0,6,0c0.8,0,1.4,0.5,1.7,1.3c1.1,2.7,2.4,5.2,4.1,7.6c0.4,0.6,0.9,1.3,1.5,1.7c0.7,0.5,1.3,0.3,1.6-0.5 c0.2-0.5,0.3-1,0.4-1.6c0.2-1.9,0.2-3.7-0.1-5.6c-0.2-1.2-0.8-1.9-2-2.1C13.9,1.5,14,1.3,14.3,1c0.5-0.6,1-0.9,1.9-0.9h7 c1.1,0.2,1.3,0.7,1.5,1.8l0,7.7c0,0.4,0.2,1.7,1,2c0.6,0.2,1-0.3,1.4-0.7c1.7-1.8,2.9-3.9,3.9-6c0.5-1,0.9-1.9,1.3-2.9 c0.3-0.7,0.7-1.1,1.6-1.1l6.7,0c0.2,0,0.4,0,0.6,0c1.1,0.2,1.4,0.7,1.1,1.8c-0.5,1.7-1.6,3.2-2.7,4.6c-1.1,1.5-2.3,3-3.4,4.6 C35.1,13.3,35.2,14,36.4,15.3L36.4,15.3z" fill="currentColor"/></g></svg>-->
<!--                        Vkontakte-->
<!--                    </button>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {API_REGISTRATION_URL} from '../api/auth';
import useValidate from "@vuelidate/core";
import { email, required, minLength, sameAs } from '@vuelidate/validators';


export default {
    name: 'Registration',
    data() {
        return {
            pending: false,
            registered: false,
            v$: useValidate(),
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            emailIsUnique: true
        }
    },
    methods: {
        sendForm() {
            this.emailIsUnique = true
            this.v$.form.$touch()
            if(!this.v$.form.$error) {
                if (this.pending === false) {
                    this.pending = true;
                    axios.post(API_REGISTRATION_URL, this.form)
                        .then(response => {

                            this.registered = true
                        })
                        .catch(errors => {
                            if(errors.response.data.errors.email) {
                                this.emailIsUnique = false
                            }
                        })
                        .then(() => {
                            this.pending = false
                        })
                }
            }
            else {
                console.log("The form is filled out incorrectly")
            }

        },
    },
    validations() {
        return {
            form: {
                name: { required, minNameLength: minLength(2) },
                email: { email, required,
                    isUnique() {
                        return Boolean(this.emailIsUnique)
                    }
                },
                password: { required, minLength:minLength(6) },
                password_confirmation: { required, sameAsPassword:sameAs(this.form.password) }
            }
        }
    },
    watch: {
        'form.email'() {
            this.emailIsUnique = true
        }
    }
}
</script>
