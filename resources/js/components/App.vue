<template>
    <div>
        <router-link to="/login">Login</router-link>
        <router-link to="/registration">Registration</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'App'
}
</script>

<style scoped>

</style>
