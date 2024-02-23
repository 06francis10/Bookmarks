<script setup>
    const props=defineProps({
        tag:{
            type:String,
            default:"Select an option"
        },
        title:{
            type:String,
            default:"Choose a country"
        }
    })
</script>
<template>

<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{props.tag}}</label>
<select id="countries" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
  <option selected>{{props.title}}</option>
  <slot/>
</select>

</template>