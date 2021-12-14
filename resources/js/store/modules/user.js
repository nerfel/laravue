import axios from "axios";
import {API_LOGOUT_URL} from "../../api/auth";

export default {
    namespaced: true,
    state() {
        return {
            token: '',
            email: '',
            name: '',
            lastName: ''

        }
    },
    mutations: {
        setUser(state, payload) {
            state.token = localStorage.getItem('auth_token')
            state.email = payload.email
            state.name = payload.name
        },
        clearUserData(state) {
            state.token = ''
            state.email = ''
            state.name = ''
            state.lastName = ''
        }
    },
    actions: {
        getUserInfo(ctx) {
            const token = localStorage.getItem('auth_token')
            if(token) {
                axios.get('/api/info', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                    .then(response => {
                        ctx.commit('setUser', response.data)
                    })
            }
        },
    },
    getters: {
        user(state) {
            return state
        }
    }
}
