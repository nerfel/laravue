<template>
    <h3 class="text-2xl font-bold text-center">User tokens</h3>
    <div class="mt-4 mx-4">
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table v-if="Object.keys(tokens).length !== 0" class="w-full">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Token id</th>
                        <th class="px-4 py-3">Date of last use</th>
                        <th class="px-4 py-3">Created at</th>
                        <th class="px-4 py-3">Updated at</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <Token
                            :token="tokens.current"
                            :isCurrent="true"
                        />
                        <transition-group
                            name="token-list"
                        >
                            <Token
                                v-for="token in tokens.other"
                                :key="token.id"
                                :token="token"
                                @delete="deleteUserToken(token)"
                            />
                        </transition-group>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Token from "./Token";
export default {
    name: "UserTokens",
    components: {Token},
    methods: {
        ...mapActions('user', ['fetchUserTokens', 'deleteUserToken']),
    },
    computed: {
        ...mapGetters('user', ['tokens'])
    },
    mounted() {
        if(Object.keys(this.tokens).length === 0) {
            this.fetchUserTokens()
        }
    }
}
</script>

<style scoped>
    .token-list-enter-active,
    .token-list-leave-active {
        transition: all .2s ease;
    }
    .token-list-enter-from,
    .token-list-leave-to {
        opacity: 0;
        transform: translateY(-50px);
    }
    .token-list-move {
        transition: transform .3s ease;
    }
</style>
