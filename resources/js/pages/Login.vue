<template>
    <div>
        <span v-if="loggedIn">Successfully logged in</span><br>
        <input type="text" v-model="form.email" placeholder="Email"><br>
        <input type="password" v-model="form.password" placeholder="Password"><br>
        <button @click="sendForm" :disabled="pending">Login</button>
    </div>
</template>

<script>
import axios from 'axios';
import { API_LOGIN_URL } from '../api/auth';

export default {
    name: 'Login',
    data() {
        return {
            pending: false,
            loggedIn: false,
            form: {
                email: null,
                password: null
            }
        }
    },
    methods: {
        sendForm() {
            if (this.pending === false) {
                this.pending = true;
                axios.post(API_LOGIN_URL, this.form)
                    .then(response => {
                        this.loggedIn = true;
                    })
                    .catch(errors => {})
                    .then(() => {
                        this.pending = false;
                    });
            }
        }
    }
}
</script>

<style scoped>

</style>
