<template>
    <h3 class="text-2xl font-bold mb-4">Profile page component</h3>
    <div class="flex justify-center flex-col">
        <ProfileInfo />
        <div class="mt-20">
            <UserTokens />
        </div>
    </div>
</template>

<script>

import ProfileInfo from "../components/ProfileInfo";
import UserTokens from "../components/Tokens/UserTokens";
export default {
    name: "Profile",
    components: { ProfileInfo, UserTokens }
}
</script>

<style scoped>

</style>
