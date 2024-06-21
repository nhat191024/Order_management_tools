<template>
    <div class="grid grid-cols-12 grid-rows-8 gap-5 h-screen w-screen ">
        <div class="col-span-2 flex items-center justify-center ">
            <RouterLink class="items-center bg-white drop-shadow-2x text-black inline-flex" to="/staff/login">
                <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
                    <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                </div>
                <span class="text-xl drop-shadow">Trở về</span>
            </RouterLink>
        </div>
        <div class="col-span-5 flex gap-3 items-center overflow-auto">
            
        </div>
        <div class="col-start-8 col-span-4 flex">
            <div class="w-full h-full flex items-center justify-center">
                <div :class="disabled" class="w-8 h-8 mr-2 rounded-full drop-shadow-sm"></div>
                <span class="text-xl drop-shadow-sm font-bold text-black">Bàn trống</span>
            </div>
            <div class="w-full h-full flex items-center justify-center">
                <div class="bg-primary w-8 h-8 mr-2 rounded-full drop-shadow-sm"></div>
                <span class="text-xl drop-shadow-sm font-bold text-black">Bàn có khách</span>
            </div>
        </div>
        <div
            class="row-span-7 col-start-2 col-span-10 overflow-auto mt-5 grid grid-row-4 grid-cols-5 gap-4 place-items-center">
            <RouterLink v-for="table in tableList" :class="table.status == 1 ? mainColor : disabled"
                v-bind:to="{ path: '/staff/table/' + table.tableName }"
                class="w-40 h-40 rounded-xl flex flex-col items-center justify-center drop-shadow-sm">
                <img src="./../../assets/sofa.svg" alt="My SVG Icon" class="w-3/4 p-5 rounded-xl">
                <span class="text-black font-extrabold pb-5 text-xl">{{ table.tableName }}</span>
            </RouterLink>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { RouterLink } from 'vue-router';
import { getTableData } from '../../api/table';

const tableList = ref([]);

onMounted(async () => {
    getTableData(1).then((res) => {
        res.forEach((table) => {
            tableList.value.push({
                tableName: table.Table_number,
                status: table.Table_status
            });
        })
    })
})
</script>

<script>
export default {
    data() {
        return {
            mainColor: 'bg-primary',
            disabled: 'bg-gray-300',
        }
    },
}
</script>