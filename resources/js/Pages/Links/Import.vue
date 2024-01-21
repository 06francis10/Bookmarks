<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import { ref } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import SuccessButton from '@/Components/SuccessButton.vue';

const modalImportshow = ref(false);
function showModalImport() {
    modalImportshow.value=true;
}
function closeModalImport() {
    modalImportshow.value=false;
}

</script>
<template>
    <div class="flex flex-row gap-2">

        <PrimaryButton @click="showModalImport">Import</PrimaryButton>
    </div>
    <DialogModal :show="modalImportshow" @close="closeModalImport()">
        <template #title>Import Bookmarks</template>
        <template #content>
            <input type="file">
        </template>
        <template #footer>
            <SuccessButton>Upload</SuccessButton>
            <DangerButton @click="closeModalImport"> Close </DangerButton>
        </template>
    </DialogModal>
</template>