import axios from "axios";

export default {
    namespaced: true,
    state: {
        info: {},
        userToken: localStorage.getItem('auth_token')
    },
    mutations: {
        setUser(state, payload) {
            state.info = payload
        },
        clearUserData(state) {
            state.info = {}
        }
    },
    actions: {
        async fetchUserInfo(ctx) {
            try {
                const response = await axios.get('/api/info', {
                    headers: {
                        'Authorization': `Bearer ${ctx.state.userToken}`
                    }
                })
                ctx.commit('setUser', response.data)

                return response.data
            }
            catch (e) {
                console.log(e)
            }
        },
        async updateUserInfo(ctx, data) {
            try {
                return axios.put('api/update-user-info', data, {
                    headers: {
                        'Authorization': `Bearer ${ctx.state.userToken}`
                    }
                })
                    .then((response) => {
                        if(response.data.success) {
                            ctx.commit('setUser', response.data.user)
                            return response.data
                        }
                        else {
                            throw response.data.message
                        }
                    })

            }
            catch (e) {
                console.log(e)
                throw e
            }
        }
    },
    getters: {
        info: state => state.info
    }
}
