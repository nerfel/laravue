<template>
    <tr class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3 text-sm">{{ token.id }}</td>
        <td class="px-4 py-3 text-sm" :class="token.last_used_at == null ? 'text-gray-400' : ''">
            {{ token.last_used_at ? token.last_used_at : 'not used' }}
        </td>
        <td class="px-4 py-3 text-sm">{{ token.created_at }}</td>
        <td class="px-4 py-3 text-sm">{{ token.updated_at }}</td>
        <td class="px-4 py-3 text-xs">
            <button
                class="px-2 py-1 font-semibold leading-tight rounded-full transition"
                :class="isCurrent ? ['bg-gray-200', 'text-gray-500', 'cursor-default'] : ['hover:bg-red-300', 'text-red-700', 'bg-red-100']"
                :disabled="isCurrent"
                @click="$emit('delete', token)"
            >
                {{ isCurrent ? 'Current session' : 'End session' }}
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    name: "Token",
    props: {
        token: {
            type: Object,
            required: true
        },
        isCurrent: {
            type: Boolean,
            required: false,
            default: false
        }
    }
}
</script>

<style scoped>

</style>
