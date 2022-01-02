<template>
    <form class="flex max-w-sm w-full justify-center bg-white shadow-md rounded-lg overflow-hidden mx-auto flex flex-col p-5"
          @submit.prevent="saveProfileInfo"
    >
        <h3 class="text-2xl font-bold mb-4">Profile info</h3>
        <div class="input-component mb-5">
            <div
                class="relative h-10"
                :class="email == '' ? 'empty' : ''"
            >
                <input v-model="email" id="email" type="text" name="email" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
                <label for="email" class="absolute left-2 transition-all bg-white px-1">
                    E-mail
                </label>
            </div>
            <ul class="flex flex-wrap items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <li
                    v-if="v$.$dirty && v$.email.required.$invalid"
                    class="invalid-feedback">
                    Required field
                </li>
                <li
                    v-if="v$.$dirty && v$.email.email.$invalid"
                    class="invalid-feedback">
                    The field must contain a valid email
                </li>
            </ul>
        </div>
        <div class="input-component mb-5">
            <div
                class="relative h-10"
                :class="name == '' ? 'empty' : ''"
            >
                <input v-model="name" id="first_name" type="text" name="name" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
                <label for="first_name" class="absolute left-2 transition-all bg-white px-1">
                    First name
                </label>
            </div>
            <ul class="flex flex-wrap items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <li
                    v-if="v$.$dirty && v$.name.required.$invalid"
                    class="invalid-feedback">
                    Required field
                </li>
            </ul>
        </div>
        <div class="input-component mb-5">
            <div
                class="relative h-10"
                :class="lastName == '' ? 'empty' : ''"
            >
                <input v-model="lastName" id="last_name" type="text" name="last_name" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
                <label for="last_name" class="absolute left-2 transition-all bg-white px-1">
                    Last name
                </label>
            </div>
        </div>
        <div class="items-center font-medium tracking-wide text-xs text-gray-400 flex mb-2">If you want to change your password, please fill in the fields below</div>
        <div class="input-component mb-5">
            <div
                class="relative h-10"
                :class="password == '' ? 'empty' : ''"
            >
                <input v-model="password" id="current_password" type="password" name="current_password" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
                <label for="current_password" class="absolute left-2 transition-all bg-white px-1">
                    Current password
                </label>
            </div>
            <ul class="flex flex-wrap items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <li
                    v-if="v$.$dirty && v$.password.minLength.$invalid"
                    class="invalid-feedback">
                    Password must be at least 6 characters long
                </li>
                <li
                    v-if="v$.$dirty && v$.password.isCorrect.$invalid"
                    class="invalid-feedback">
                    Invalid user password
                </li>
            </ul>
        </div>
        <div class="input-component mb-5">
            <div
                class="relative h-10"
                :class="newPassword == '' ? 'empty' : ''"
            >
                <input v-model="newPassword" id="new_password" type="password" name="new_password" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
                <label for="new_password" class="absolute left-2 transition-all bg-white px-1">
                    New password
                </label>
            </div>
            <ul class="flex flex-wrap items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <li
                    v-if="v$.$dirty && v$.newPassword.minLength.$invalid"
                    class="invalid-feedback">
                    Password must be at least 6 characters long
                </li>
                <li
                    v-if="v$.$dirty && v$.newPassword.requiredIfPassword.$invalid"
                    class="invalid-feedback">
                    Password must be set
                </li>
            </ul>
        </div>
        <div class="input-component mb-5">
            <div
                class="relative h-10"
                :class="passwordConfirm == '' ? 'empty' : ''"
            >
                <input v-model="passwordConfirm" id="password_confirm" type="password" name="new_password" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
                <label for="password_confirm" class="absolute left-2 transition-all bg-white px-1">
                    Confirm password
                </label>
            </div>
            <ul class="flex flex-wrap items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <li
                    v-if="v$.$dirty && v$.passwordConfirm.minLength.$invalid"
                    class="invalid-feedback">
                    Password must be at least 6 characters long
                </li>
                <li
                    v-if="v$.$dirty && v$.passwordConfirm.requiredIfPassword.$invalid"
                    class="invalid-feedback">
                    Password must be set
                </li>
                <li
                    v-if="v$.$dirty && v$.passwordConfirm.sameAsNewPassword.$invalid"
                    class="invalid-feedback">
                    The field must match the password entered above
                </li>
            </ul>
        </div>
        <div class="relative h-10 input-component flex">
            <button type="submit" class="px-3 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none duration-100 ease-in-out ml-auto"> Save </button>
        </div>
    </form>
</template>

<script>
import {email, minLength, required, requiredIf, sameAs} from "@vuelidate/validators";
import { mapGetters, mapActions } from 'vuex';
import useValidate from "@vuelidate/core";

export default {
    name: "ProfileInfo",
    data: () => ({
        name: '',
        lastName: '',
        email: '',
        password: '',
        newPassword: '',
        passwordConfirm: '',
        v$: useValidate(),
        passwordIsCorrect: true
    }),
    methods: {
        async saveProfileInfo() {
            if(this.v$.$invalid) {
                this.v$.$touch()
                return
            }

            await this.updateUserInfo({
                name: this.name,
                email: this.email,
                lastName: this.lastName,
                password: this.password,
                newPassword: this.newPassword
            })
                .then(
                    data => {
                        if(data.success) {
                            this.password = this.newPassword
                            this.newPassword = ''
                            this.passwordConfirm = ''
                        }
                    }
                )
                .catch(
                    error => {
                        if(error === 'Invalid user password') {
                            this.passwordIsCorrect = false
                        }
                    }
                )

        },
        ...mapActions('user', ['updateUserInfo'])
    },
    computed: {
        ...mapGetters('user', ['info'])
    },
    watch: {
        info() {
            this.name = this.info.name
            this.email = this.info.email
            this.lastName = this.info.lastName
        },
        password() {
            this.passwordIsCorrect = true
        }
    },
    validations() {
        return {
            name: { required },
            email: { email, required },
            password: { minLength:minLength(6), isCorrect() { return Boolean(this.passwordIsCorrect) }},
            newPassword: { minLength: minLength(6), requiredIfPassword: requiredIf(this.password) },
            passwordConfirm: {minLength: minLength(6), requiredIfPassword: requiredIf(this.password), sameAsNewPassword:sameAs(this.newPassword)}
        }
    },
    mounted() {
        this.name = this.info.name
        this.email = this.info.email
        this.lastName = this.info.lastName
    }
}

</script>

<style scoped>
    label {
        top: 0%;
        transform: translateY(-50%);
        font-size: 11px;
        color: rgba(37, 99, 235, 1);
    }
    .empty input:not(:focus) + label {
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
    }
    input:not(:focus) + label {
        color: rgba(70, 70, 70, 1);
    }
    input {
        border-width: 1px;
    }
    input:focus {
        outline: none;
        border-color: rgba(37, 99, 235, 1);
    }
</style>
