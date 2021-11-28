<template>
    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white text-black">
        <header class="fixed w-full flex items-center justify-between h-14 text-white z-10 bg-blue-800">
            <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-blue-800 border-none">
                <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden" src="/images/default-avatar.jpg" />
                <span class="hidden md:block">{{ user.name }}</span>
            </div>
            <div class="flex justify-between items-center h-14 bg-blue-800 header-right">
                <ul class="flex items-center">
                    <li>
                        <div class="block w-px h-6 mx-3 bg-gray-400"></div>
                    </li>
                    <li>
                        <button
                            class="flex items-center mr-4 hover:text-blue-100"
                            @click="logout"
                        >
                            <span class="inline-flex mr-1">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </span>
                            Logout
                        </button>
                    </li>
                </ul>
            </div>
        </header>
        <!-- Sidebar -->
        <Sidebar></Sidebar>
        <!-- ./Sidebar -->
        <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
            <router-view :user="user" />
        </div>
    </div>
</template>

<script>
import {API_LOGOUT_URL} from "../api/auth";
import Sidebar from "../components/Sidebar";
import axios from "axios";

export default {
    name: "MainLayout",
    components: { Sidebar },
    data() {
        return {
            user: {
                token: localStorage.getItem('auth_token'),
                name: '',
                email: ''
            }
        }
    },
    methods: {
        logout() {
            console.log("производим логаут")

            axios.delete(API_LOGOUT_URL, {
                headers: {
                    'Authorization': `Bearer ${this.user.token}`
                }
            })
                .then(response => {
                    if(response.data.success) {
                        localStorage.removeItem('auth_token')
                        this.$router.push({name: 'login'})
                    }
                })
                .catch(errors => {});
        }
    },
    mounted() {
        axios.get('/api/info', {
            headers: {
                'Authorization': `Bearer ${this.user.token}`
            }
        })
            .then(response => {
                this.user.email = response.data.email
                this.user.name = response.data.name
            })
    }


}
</script>
