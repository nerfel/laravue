import axios from "axios";

export default {
    namespaced: true,
    state: {
        info: {},
        userToken: localStorage.getItem('auth_token'),
        tokensList: {}
    },
    mutations: {
        setUser(state, payload) {
            state.info = payload
        },
        clearUserData(state) {
            state.info = {}
        },
        setUserToken(state) {
            state.userToken = localStorage.getItem('auth_token')
        },
        setTokens(state, payload) {
            state.tokensList = payload
        },
        removeToken(state, payload) {
            state.tokensList.other = state.tokensList.other.filter(t => t.id !== payload)
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
        },
        fetchUserTokens(ctx) {
            return axios.get('/api/user-tokens', {
                headers: {
                    'Authorization': `Bearer ${ctx.state.userToken}`
                }
            })
                .then((response) => {
                    ctx.commit('setTokens', response.data)
                })
        },
        deleteUserToken(ctx, data) {
            return axios.delete(`api/delete-user-token/${data.id}`, {
                headers: {
                    'Authorization': `Bearer ${ctx.state.userToken}`
                }
            })
                .then((response) => {
                    if(response.data.success) {
                        ctx.commit('removeToken', data.id)
                    }
                })
        }
    },
    getters: {
        info: state => state.info,
        tokens: state => state.tokensList
    }
}
