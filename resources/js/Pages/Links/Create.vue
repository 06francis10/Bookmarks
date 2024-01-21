<script setup>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import { reactive, ref } from 'vue';
    import { router } from '@inertiajs/vue3';
    import { onUpdated } from 'vue';
    import { nextTick } from 'vue';

    onUpdated(() => {
    nextTick().then(() => {
        const savedScrollPosition = window.localStorage.getItem('scrollPosition');
        if (savedScrollPosition) {
            window.scrollTo(0, parseInt(savedScrollPosition));
            window.localStorage.removeItem('scrollPosition');
        }
    });
});

    const showModal=ref(false);

    function closeModal(){
        showModal.value=false;
    }
    function openModal(){
        showModal.value=true;
    }
    const form=reactive({
        name:"",
        address:"",
    });
    function submit(){
        window.localStorage.setItem('scrollPosition', window.scrollY);
        router.post(route("link.store"),form);
    }

</script>
<template>
    <div class="flex flex-row gap-2">
        <PrimaryButton @click="openModal">Create</PrimaryButton>
    </div>
    <DialogModal @close="closeModal" :show="showModal">
        <template #title>Create New bookmark</template>
        <template #content>
            <div class="flex flex-col gap-2">
                <input type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Name" v-model="form.name" @keydown.enter="submit()">
                <input type="url" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Address" v-model="form.address">
            </div>
        </template>
        <template #footer>
            <div class="flex flex-row gap-3">
                <PrimaryButton @click="submit">Save</PrimaryButton>
                <DangerButton @click="closeModal">Cancel</DangerButton>
            </div>
        </template>
    </DialogModal>
</template>