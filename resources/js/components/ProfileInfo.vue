<template>
    <form class="flex max-w-sm w-full h-64 justify-center bg-white shadow-md rounded-lg overflow-hidden mx-auto flex flex-col p-5">
        <h3 class="text-2xl font-bold mb-4">Profile info</h3>
        <div
            class="relative h-10 input-component mb-5"
            :class="user.name == '' ? 'empty' : ''"
        >
            <input v-model="user.name" id="name" type="text" name="name" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
            <label for="name" class="absolute left-2 transition-all bg-white px-1">
                Name
            </label>
        </div>
        <div
            class="relative h-10 input-component mb-5"
            :class="user.email == '' ? 'empty' : ''"
        >
            <input v-model="user.email" id="email" type="text" name="email" class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm">
            <label for="email" class="absolute left-2 transition-all bg-white px-1">
                E-mail
            </label>
        </div>
        <div class="relative h-10 input-component">
            <button type="submit" class="px-3 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none duration-100 ease-in-out"> Save </button>
        </div>
    </form>
</template>

<script>
import {email, minLength, required} from "@vuelidate/validators";
import { mapGetters } from 'vuex';

export default {
    name: "ProfileInfo",
    data() {
      return {
          password: '',
          passwordConfirm: ''
      }
    },
    methods: {
      saveProfileInfo() {
        console.log('go save?')
      }
    },
    computed: mapGetters('user', ['user']),
    validations() {
        return {
            form: {
                email: { email, required },
                password: { required, minLength:minLength(6) }
            }
        }
    },
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
