<template>
    <div class="grid grid-cols-12 grid-rows-8 gap-5 h-screen w-screen ">
        <div class="col-span-3 flex items-center justify-center">
            <details class="dropdown">
                <summary class="h-20 btn bg-white hover:bg-primary shadow-none mt-3">
                    <button type="button" id="menu-button" aria-expanded="true" aria-haspopup="true">
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
                <ul class="p-0 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-40 mt-2 -translate-x-5">
                    <li>
                        <button @click="signOut()" type="button"
                            class=" w-full px-4 py-2 text-center text-lg font-bold text-gray-700 hover:bg-primary hover:text-white"
                            role="menuitem" tabindex="-1" id="menu-item-3">
                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1 0C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 0 0.734784 0 1V13C0 13.2652 0.105357 13.5196 0.292893 13.7071C0.48043 13.8946 0.734784 14 1 14C1.26522 14 1.51957 13.8946 1.70711 13.7071C1.89464 13.5196 2 13.2652 2 13V1C2 0.734784 1.89464 0.48043 1.70711 0.292893C1.51957 0.105357 1.26522 0 1 0ZM11.293 9.293C11.1108 9.4816 11.01 9.7342 11.0123 9.9964C11.0146 10.2586 11.1198 10.5094 11.3052 10.6948C11.4906 10.8802 11.7414 10.9854 12.0036 10.9877C12.2658 10.99 12.5184 10.8892 12.707 10.707L15.707 7.707C15.8945 7.51947 15.9998 7.26516 15.9998 7C15.9998 6.73484 15.8945 6.48053 15.707 6.293L12.707 3.293C12.6148 3.19749 12.5044 3.12131 12.3824 3.0689C12.2604 3.01649 12.1292 2.9889 11.9964 2.98775C11.8636 2.9866 11.7319 3.0119 11.609 3.06218C11.4861 3.11246 11.3745 3.18671 11.2806 3.2806C11.1867 3.3745 11.1125 3.48615 11.0622 3.60905C11.0119 3.73194 10.9866 3.86362 10.9877 3.9964C10.9889 4.12918 11.0165 4.2604 11.0689 4.3824C11.1213 4.50441 11.1975 4.61475 11.293 4.707L12.586 6H5C4.73478 6 4.48043 6.10536 4.29289 6.29289C4.10536 6.48043 4 6.73478 4 7C4 7.26522 4.10536 7.51957 4.29289 7.70711C4.48043 7.89464 4.73478 8 5 8H12.586L11.293 9.293Z"
                                    fill="#90A4AE"></path>
                            </svg>
                            Đăng xuất </button>
                    </li>
                </ul>
            </details>
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
// Để lấy username cần gọi đến API
// Sẽ thêm hotfix sau khi API này được làm xong / merged
const username = ref('admin');
const route = useRouter();
const userIdFromCookie = ref('1');

onMounted(async () => {
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