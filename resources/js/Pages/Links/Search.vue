<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props=defineProps({
    buscar: String,
    sortBy: String,
})

const form=reactive({
    search:props.buscar,
    sortBy:props.sortBy,
});

function submit(){
    if((form.search==null || form.search=="") && (form.sortBy==null ||form.sortBy=="")){
        router.get(route('dashboard'))
    }else if(form.search==null || form.search==""){
        router.get(route('dashboard'),{"sortBy":form.sortBy})
    }else if(form.sortBy==null || form.sortBy==""){
        router.get(route('dashboard'),{"search":form.search})
    }else{
        router.get(route('dashboard',form))
    }
}
</script>
<template>
    <form method="get" class="flex flex-row" @submit.prevent="submit">
        <TextInput v-model="form.search" placeholder="Buscar..."></TextInput>
        <select name="" v-model="form.sortBy" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">Ordenar Por</option>
            <option value="title">title</option>
            <option value="url">url</option>
        </select>
        <SecondaryButton type="submit">Buscar</SecondaryButton>
    </form>
</template>