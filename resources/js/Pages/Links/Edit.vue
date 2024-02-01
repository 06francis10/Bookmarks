<script setup>
// imports
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineEmits } from 'vue';

// variables

const props = defineProps({
    viewModal: {
        type: Boolean,
        default: false,
    },
    errors: Object,
    link: Object,
})
const emit=defineEmits(['closeModalEdit'])
const form = useForm({
    id: null,
    name: null,
    address: null,
})

// functions

watch(() => props.link, (newLink) => {
    if(props.link!=null){
        form.id = newLink.id;
        form.name = newLink.title;
        form.address = newLink.url;
    }
})
function submit() {
    form.put(route('link.update', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            form.clearErrors()
            emit('closeModalEdit');
        }
    })
}
function cerrarModal () {
    form.reset();
    form.clearErrors()
    emit('closeModalEdit');
}
</script>
<template>
    <DialogModal :show="viewModal" @close="cerrarModal">
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
                    <input type="text"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        placeholder="Address" v-model="form.address">
                    <div v-if="props.errors.address">{{ props.errors.address }}</div>
                </div>
            </form>
        </template>
        <template #footer>
            <div class="flex justify-end gap-2">
                <PrimaryButton form="bookmark-form-edit" :disabled="form.processing">Edit</PrimaryButton>
                <DangerButton @click="cerrarModal">Cancel</DangerButton>
            </div>
        </template>
    </DialogModal>
</template>