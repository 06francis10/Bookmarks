<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import SelectMenu from '@/Components/SelectMenu.vue';

const show = ref(false)
const showModal = () => {
    show.value = true
}
const closeModal = () => {
    show.value = false
}
</script>
<template>
    <SecondaryButton @click="showModal">Export</SecondaryButton>
    <DialogModal :show="show" @close="closeModal">
        <template #title>Export Bookmarks</template>
        <template #content>
            <div>
                <SelectMenu :title="`Select formart file`">
                    <option>Sql</option>
                    <option>json</option>
                    <option>txt</option>
                    <option>xlsx</option>
                </SelectMenu>
                <TextInput type="password" class="mt-1 block w-3/4" placeholder="Password" autocomplete="current-password"></TextInput>
            </div>
        </template>
        <template #footer>
            <div class="flex gap-3">
                <PrimaryButton @click="">Export</PrimaryButton>
                <DangerButton @click="closeModal">Cancel</DangerButton>
            </div>
        </template>
    </DialogModal>
</template>