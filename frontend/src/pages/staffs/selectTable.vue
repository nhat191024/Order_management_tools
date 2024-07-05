<template>
    <div class="grid grid-cols-12 grid-rows-8 gap-5 h-screen w-screen ">
        <div class="col-span-3 flex items-center justify-center">
            <div class="dropdown">
                <div tabindex="0" role="button" class="m-1">
                    <img class="bg-white w-16 h-16 mr-2 rounded-full border shadow-lg"
                        src="../../assets/logo.jpg"></img>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Xin chào {{ username }} !</a></li>
                    <li><button @click="logout">Đăng Xuất</button></li>
                </ul>
            </div>
            <p class="font-bold text-xl">Thương ốc</p>
        </div>
        <div class="col-span-4 flex gap-3 items-center overflow-auto">
        </div>
        <div class="col-start-8 col-span-4 flex justify-center">
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
                class="w-40 h-40 rounded-xl flex flex-col items-center justify-center drop-shadow-md">
                <img src="./../../assets/sofa.svg" alt="My SVG Icon" class="w-3/4 p-5 rounded-xl">
                <span class="text-black font-extrabold pb-5 text-xl">Bàn {{ table.tableName }}</span>
            </RouterLink>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import { getTableData } from '../../api/table';
import { logoutHandle } from '../../api/login';
import { getCookie } from '../../api/functions';

const router = useRouter();
const tableList = ref([]);
const username = getCookie('Username');
const userId = getCookie('Id');
const mainColor = 'bg-primary';
const disabled = 'bg-gray-300';

onMounted(async () => {
    getTableData(userId).then((res) => {
        res.forEach((table) => {
            tableList.value.push({
                tableName: table.Table_number,
                status: table.Table_status
            });
        })
    })
})

function logout() {
    logoutHandle();
    router.push('/staff/login');
}
</script>