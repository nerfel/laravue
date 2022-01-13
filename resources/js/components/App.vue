<template>
    <component :is="layout">
        <router-view />
    </component>
</template>

<script>
import AuthLayout from "../layouts/AuthLayout";
import MainLayout from "../layouts/MainLayout";
export default {
    name: 'App',
    components: {
        AuthLayout,
        MainLayout
    },
    computed: {
        layout() {
            return `${this.$route.meta.layout || 'main'}-layout`
        }
    }
}
</script>

<style>
    .spinner-border {
        color: #1e40af;
        display: inline-block;
        width: 2rem;
        height: 2rem;
        border: 0.25em solid;
        border-right: 0.25em solid transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
    }
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0,0,0,0);
        white-space: nowrap;
        border: 0;
    }
    @keyframes spinner-border {
        to { transform: rotate(1turn); }
    }
</style>
