<template>
    <div class="grid grid-cols-12 grid-rows-8 gap-5 h-screen w-screen ">
        <div class="col-span-3 flex items-center justify-center">
            <details class="dropdown">
                <summary class="h-20 btn bg-white shadow-none mt-3">
                    
                    <button type="button"
                        
                        id="menu-button" aria-expanded="true" aria-haspopup="true">

                        <div class="items-center drop-shadow-2x text-black inline-flex">

                            <img class="bg-white w-16 h-16 mr-2 rounded-full border shadow-lg"
                                src="../../assets/logo.jpg"></img>
                            <!-- <span class="text-xl drop-shadow-sm font-bold text-black">{{ username }}</span> -->


                            <svg class="-mr-1 h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                </summary>
                <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-40 mt-2 -translate-x-5">
                    <li><button @click="signOut()" type="button"
                            class="block w-full px-4 py-2 text-center text-lg font-bold text-gray-700" role="menuitem"
                            tabindex="-1" id="menu-item-3">
                            Đăng xuất </button></li>
                </ul>
            </details>


            <!-- <RouterLink to="/staff/login">

                <div class="">
                        <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                </div>
                <span class="text-xl drop-shadow">Trở về</span>

            </RouterLink> -->



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
                <span class="text-black font-extrabold pb-5 text-xl">{{ table.tableName }}</span>
            </RouterLink>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import { getTableData } from '../../api/table';
import { logout } from '../../api/login';

const tableList = ref([]);
const username = ref('admin');
const route = useRouter();
const userIdFromCookie = ref('1');

onMounted(async () => {
    // get user id from cookie
    userIdFromCookie.value = document.cookie.split(';').find(cookie => cookie.includes('Id')).split('=')[1];

    let userId = userIdFromCookie.value;
    console.log(userId);
    getTableData(userId).then((res) => {
        res.forEach((table) => {
            tableList.value.push({
                tableName: table.Table_number,
                status: table.Table_status
            });
        })
    })
})
function signOut() {
    logout();
    route.push('/staff/login');
}
</script>

<script>
export default {
    data() {
        return {
            mainColor: 'bg-primary',
            disabled: 'bg-gray-300',
        }
    }
}
</script>