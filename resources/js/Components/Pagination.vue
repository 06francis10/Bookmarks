<template>
    <nav aria-label="Page navigation example" class="flex justify-center p-4">
        <ul class="inline-flex -space-x-px text-sm">
            <li v-for="link in pagination" :key="link.label">
                <div v-if="link.active"
                    class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                    v-html="link.label"></div>
                <div v-else-if="link.label === '...'"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    v-html="link.label"></div>
                <Link v-else-if="link.label.includes('Next')" :href="link.url" v-html="link.label" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></Link>
                <Link v-else-if="link.label.includes('Previous')" :href="link.url" v-html="link.label" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></Link>
                <Link v-else :href="link.url"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    v-html="link.label">
                </Link>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default {
        props: {
            pagination: Object
        },
    }
</script>