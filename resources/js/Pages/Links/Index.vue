<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableView from '@/Components/TableView.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import Create from './Create.vue';
import { router, useForm } from '@inertiajs/vue3';
import Search from './Search.vue';
import Import from './Import.vue';

const props = defineProps({
    links: Object,
    buscar: String,
    sortBy: String,
    errors: Object,
    orderBy: String,
})

const ModalDelete = ref(false)

const showModalEdit = ref(false)

const link = ref(null)
const showModal = (c) => {
    form.id = c.id,
        form.name = c.title,
        form.address = c.url,
        showModalEdit.value = true
};
const closeModal = () => {
    showModalEdit.value = false;
    form.reset();
    form.clearErrors()
};

const form = useForm({
    id: null,
    name: null,
    address: null,
})
const formDelete = useForm({
    id: null,
})

function submit() {
    form.put(route('link.update', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            form.clearErrors()
            closeModal();
        }
    })
}

function eliminar(id) {
    formDelete.id = id;
    formDelete.delete(route("link.destroy", { "id": id }), {
        preserveScroll: true,
        onSuccess: () => {
            formDelete.reset();
            formDelete.clearErrors()
            closeModalDelete();
        }
    })
}

const showModalDelete = (c) => {
    link.value = c
    ModalDelete.value = true;
}

function closeModalDelete() {
    ModalDelete.value = false;
    link.value = null
}

function orderBy(params) {
    console.log(props.orderBy)
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
                    <Search :buscar="props.buscar" :sort-by="props.sortBy" class="max-md:order-last"></Search>
                    <Import></Import>
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
        <DialogModal :show="showModalEdit" @close="closeModal">
            <template #title>
                Editar Marcadores
            </template>
            <template #content>
                <form id="bookmark-form-edit" @submit.prevent="submit">
                    <div class="flex flex-col gap-3">
                        <input type="text"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            placeholder="Name" v-model="form.name">
                        <div v-if="props.errors.name">{{ props.errors.name }}</div>
                        <input type="url"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            placeholder="Address" v-model="form.address">
                        <div v-if="props.errors.address">{{ props.errors.address }}</div>
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="flex justify-end gap-2">
                    <PrimaryButton form="bookmark-form-edit" :disabled="form.processing">Edit</PrimaryButton>
                    <DangerButton @click="closeModal">Cancel</DangerButton>
                </div>
            </template>
        </DialogModal>
        <DialogModal :show="ModalDelete" @close="closeModalDelete">
            <template #title>Delete Bookmark</template>
            <template #content>
                Are you sure you want to delete this Bookmark?
                <p><b>{{ link.title }}</b></p>
                <p><b>{{ link.url }}</b></p>
            </template>
            <template #footer>
                <div class="flex gap-3">
                    <DangerButton @click="eliminar(link.id)">Destroy</DangerButton>
                    <PrimaryButton @click="closeModalDelete">Close</PrimaryButton>
                </div>
            </template>
        </DialogModal>
    </AppLayout>
</template>