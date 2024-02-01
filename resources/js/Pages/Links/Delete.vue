<script setup>
// Imports
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { defineEmits } from 'vue';
// Variable
const emit=defineEmits(['closeModalDelete'])

const props = defineProps({
    viewModal: {
        type: Boolean,
        default: false,
    },
    errors: Object,
    link: Object,
})

const formDelete = useForm({
    id: null,
})
const form = useForm({
    id: null,
    name: null,
    address: null,
})

// functions

function cerrarModal () {
    form.reset();
    form.clearErrors()
    emit('closeModalDelete');
}
function eliminar(id) {
    formDelete.id = id;
    formDelete.delete(route("link.destroy", { "id": id }), {
        preserveScroll: true,
        onSuccess: () => {
            formDelete.reset();
            formDelete.clearErrors()
            emit('closeModalDelete');
        }
    })
}
</script>
<template>
    <DialogModal :show="viewModal" @close="cerrarModal">
        <template #title>Delete Bookmark</template>
        <template #content>Are you sure you want to delete this Bookmark?
            <p><b>{{ link.title }}</b></p>
            <p><b>{{ link.url }}</b></p>
        </template>
        <template #footer>
            <div class="flex gap-3">
                <DangerButton @click="eliminar(link.id)">Destroy</DangerButton>
                <PrimaryButton @click="cerrarModal">Close</PrimaryButton>
            </div>
        </template>
    </DialogModal>
</template>