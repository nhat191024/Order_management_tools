<template>
    <div class="grid grid-rows-12 w-dvw h-dvh">
        <nav class="bg-primary row-span-1 flex items-center justify-between px-4 rounded-b-lg">
            <img class="rounded-full w-14 h-14" src="/src/assets/logo.jpg" alt="Logo" />
            <p class="text-white text-2xl font-semibold">Bàn {{ id }}</p>
        </nav>
        <div role="tablist" class="tabs tabs-lifted row-span-1 flex items-center overflow-auto">
            <button v-for="(tab, index) in category" role="tab" class="tab h-1/2" @click="tabChange(tab.id)">
                {{ tabStatus.value }}
            </button>
        </div>

        <div class="row-span-9">

        </div>
        <div class="flex bg-white border-t-4 items-center justify-center">
            <img src="/src/assets/Vector.svg" alt="Cart" class="h-10" />
            <span class="rounded-full bg-primary self-start px-1 mt-1 -ml-4 text-white border border-white">14</span>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const id = route.params.id;
const category = ref([
    { id: 1, name: 'Normal' },
    { id: 2, name: 'Special' },
    { id: 3, name: 'Combo' },
    { id: 4, name: 'Drink' },
    { id: 5, name: 'Dessert' },
    { id: 6, name: 'Other' }
])
const tabStatus = ref([]);

function pushTabStatus() {
    category.value.forEach((item) => {
        tabStatus.value.push({ id: item.id, status: false });
    });
}
pushTabStatus();

function tabChange(id) {
    tabStatus.value.forEach((item) => {
        if (item.id === id) {
            item.status = true;
        } else {
            item.status = false;
        }
    });
}

console.log(tabStatus.value[0]);
</script>