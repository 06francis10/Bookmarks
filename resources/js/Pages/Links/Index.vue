<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableView from '@/Components/TableView.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
defineProps({
    links: Object
})
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-20">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl">
                    <TableView>
                        <template v-slot:thead>
                            <tr class="bg-blue-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left">Title</th>
                                <th class="py-3 px-4 text-left">URL</th>
                                <th class="py-3 px-4 text-center">Action</th>
                            </tr>
                        </template>
                        <template v-slot:tbody>
                            <tr v-for="link in links.data" :key="link.id" class="border-b border-blue-gray-200 h-auto w-full">
                                <td class="py-3 px-4 w-6/12 max-w-20">{{ link.title }}</td>
                                <td class="py-3 px-4 w-6/12 max-w-20">
                                    <a :href=link.url target="_blank" class="break-words">{{ link.url }}</a>
                                </td>
                                <td class="py-3 px-4 flex flex-col gap-3">
                                    <DangerButton>Editar</DangerButton>
                                    <DangerButton>Delete</DangerButton>
                                </td>
                            </tr>
                        </template>
                    </TableView>
                </div>
                <Pagination :pagination="links.links"></Pagination>
            </div>
        </div>
    </AppLayout>
</template>