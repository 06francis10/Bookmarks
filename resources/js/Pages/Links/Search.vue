<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props=defineProps({
    buscar: {type:String,default:null},
    sortBy: {type:String,default:null},
})

const form=reactive({
    search:props.buscar,
});

function submit(){
    if((form.search==null || form.search=="")){
        router.get(route('dashboard'))
    }else{
        router.get(window.location.href,form);
    }
}
</script>
<template>
    <form method="get" class="flex flex-row" @submit.prevent="submit">
        <TextInput v-model="form.search" placeholder="Buscar..." required></TextInput>
        <SecondaryButton type="submit">Buscar</SecondaryButton>
    </form>
    <SecondaryButton @click="router.get(route('dashboard'))">Restart</SecondaryButton>
</template>