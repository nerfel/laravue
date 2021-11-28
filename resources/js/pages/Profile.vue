<template>
    <h3 class="text-2xl font-bold mb-4">Profile page component</h3>
    <div class="flex justify-center h-screen items-center">
        <ProfileInfo :user="user" />
    </div>
</template>

<script>

import ProfileInfo from "../components/ProfileInfo";
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    name: "Profile",
    components: { ProfileInfo },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
