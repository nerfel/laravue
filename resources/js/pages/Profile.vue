<template>
    <h3 class="text-2xl font-bold mb-4">Profile page component</h3>
    <div class="flex justify-center">
        <ProfileInfo />
    </div>
</template>

<script>

import ProfileInfo from "../components/ProfileInfo";
export default {
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
