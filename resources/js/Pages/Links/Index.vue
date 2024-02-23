<script setup>
// Imports
import Export from './Export.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import TableView from '@/Components/TableView.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import Create from './Create.vue';
import { router } from '@inertiajs/vue3';
import Search from './Search.vue';
import Import from './Import.vue';
import Edit from './Edit.vue';
import Delete from './Delete.vue'
// variables
const props = defineProps({
    links: Object,
    buscar: {type:String,default:""},
    sortBy: {type:String,default:""},
    errors: Object,
    orderBy: String,
})
const ModalDelete = ref(false)
const showModalEdit = ref(false)
const link = ref(null)
// functions
const showModal = (c) => {
    link.value = c;
    showModalEdit.value = true
};
const closeModal = () => {
    showModalEdit.value = false;
}
const showModalDelete = (c) => {
    link.value = c
    ModalDelete.value = true;
}
function closeModalDelete() {
    link.value = null
    ModalDelete.value = false;
}

function orderBy(params) {
    var order = props.orderBy;
    if (props.orderBy == "desc") {
        order = "asc";
    } else {
        order = "desc";
    }
    router.get(window.location.href, { "orderBy": order, "sortBy": params, })
}
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
                <div class="my-3 flex flex-row gap-2 justify-between max-md:flex-col max-md:m-4">
                    <Create :errors="props.errors"></Create>
                    <Search :buscar="props.buscar" :sort-by="props.sortBy"></Search>
                    <Import></Import>
                    <Export></Export>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl">
                    <TableView>
                        <template v-slot:thead>
                            <tr class="bg-blue-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left hover:bg-slate-200 rounded-xl cursor-pointer"
                                    @click="orderBy('title')">Title</th>
                                <th class="py-3 px-4 text-left hover:bg-slate-200 rounded-xl cursor-pointer"
                                    @click="orderBy('url')">URL</th>
                                <th class="py-3 px-4 text-center">Action</th>
                            </tr>
                        </template>
                        <template v-slot:tbody>
                            <tr v-for="link in props.links.data" :key="link.id"
                                class="border-b border-blue-gray-200 h-auto w-full">
                                <td class="py-3 px-4 w-6/12 max-w-20">{{ link.title }}</td>
                                <td class="py-3 px-4 w-6/12 max-w-20">
                                    <a :href=link.url target="_blank" class="break-words">{{ link.url }}</a>
                                </td>
                                <td class="py-3 px-4 flex flex-col gap-3">
                                    <PrimaryButton @click="showModal(link)">Editar</PrimaryButton>
                                    <DangerButton @click="showModalDelete(link)">Delete</DangerButton>
                                </td>
                            </tr>
                        </template>
                    </TableView>
                </div>
                <Pagination :pagination="props.links.links"></Pagination>
            </div>
        </div>
    </AppLayout>
    <Edit :errors="errors" :link="link" :view-modal.sync="showModalEdit" @close-modal-edit="closeModal()"></Edit>
    <Delete :errors="errors" :link="link" :view-modal.sync="ModalDelete" @close-modal-delete="closeModalDelete()"></Delete>
</template>