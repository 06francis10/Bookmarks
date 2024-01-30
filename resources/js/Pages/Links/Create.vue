<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

defineProps({ errors: Object })
const showModal = ref(false);

function closeModal() {
    showModal.value = false;
}
function openModal() {
    showModal.value = true;
}
const form = useForm({
    name: null,
    address: null,
});
function submit() {
    form.post(route("link.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    })
}

</script>
<template>
    <div class="flex flex-row gap-2">
        <PrimaryButton @click="openModal">Create</PrimaryButton>
    </div>
    <DialogModal @close="closeModal" :show="showModal">
        <template #title>Create New bookmark</template>
        <template #content>
            <form id="bookmark-form" @submit.prevent="submit">
                <div class="flex flex-col gap-2">
                    <input type="text"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        placeholder="Name" v-model="form.name" required>
                        <div v-if="errors.name">{{ errors.name }}</div>
                    <input type="url"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        placeholder="Address" v-model="form.address" required>
                        <div v-if="errors.address">{{ errors.address }}</div>
                </div>
            </form>
        </template>
        <template #footer>
            <div class="flex flex-row gap-3">
                <PrimaryButton form="bookmark-form" :disabled="form.processing">Save</PrimaryButton>
                <DangerButton @click="closeModal">Cancel</DangerButton>
            </div>
        </template>
    </DialogModal>
</template>