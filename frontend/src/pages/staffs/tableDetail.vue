<template>
    <div class="w-full h-full grid grid-cols-12 grid-rows-10">
        <div class="col-span-3 row-span-1 border-r border-black flex">
            <RouterLink class="items-center bg-white drop-shadow-2x text-black inline-flex" to="/staff/table">
                <div class="bg-primary w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
                    <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                </div>
                <span class="text-xl drop-shadow">Trở về</span>
            </RouterLink>
        </div>
        <div class="col-span-3 row-start-2 row-span-full border-r border-black overflow-auto">
            <div v-for="item in menu"
                class="w-full collapse collapse-arrow bg-primary rounded-none border-b border-black text-white">
                <input type="radio" name="my-accordion-2 " />
                <div class="collapse-title text-lg font-medium shadow-md">
                    {{ item.Category_name }}
                </div>
                <div class="collapse-content bg-secondary p-0 m-0">
                    <template v-for="food in item.Foods  ">
                        <div v-for="dish in food.Dishes"
                            class="w-full h-fit p-4 font-medium text-lg flex items-center justify-between border-b border-white ">
                            <div>
                                <p>
                                    <span>{{ food.Food_name + " " }}</span>
                                    <span
                                        :class="dish.Dish_cooking_method.Cooking_method_name == 'nước' ? 'hidden' : ''">
                                        {{ dish.Dish_cooking_method.Cooking_method_name }}
                                    </span>
                                </p>
                            </div>
                            <button
                                class="w-6 h-6 flex justify-center transition-all transform linear duration-300 active:scale-90 active:fill-green-600"
                                @click="addDish(item.Category_id, food.Food_id, dish.Dish_id)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    class=" fill-white active:fill-green-600">
                                    <!-- Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="col-start-4 col-span-5 self-center text-center font-bold text-4xl text-primary">
            Bàn {{ table }}
        </div>
        <div class="col-start-4 col-span-5 row-start-2 row-span-8 px-4 overflow-auto">
            <div v-for="(dishes, index) in tableDish"
                class="h-32 mb-2 bg-primary shadow-md rounded-lg flex flex-col text-white">
                <div class="flex items-center justify-between">
                    <div class="flex gap-2">
                        <img src="../../assets/demo.jpg" alt="demo" class="ml-3 mt-3 w-16 h-16 rounded-lg" />
                        <div class="flex flex-col justify-center mt-2">
                            <p class="font-extrabold w-52">{{ dishes.dish_name }}</p>
                            <p>Giá: {{ formatPrice(dishes.dish_price) }} VNĐ</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mr-2">
                        <div class="flex items-center gap-3 px-2 py-1 rounded-full bg-white">
                            <button class="transition-all transform linear duration-300 active:scale-150"
                                @click="decreaseQuantity(index)">
                                <img src="../../assets/minus.svg" alt="minus" class=" w-4">
                            </button>
                            <p class="text-center text-primary ">{{ dishes.dish_quantity }}</p>
                            <button class="transition-all transform linear duration-300 active:scale-150"
                                @click="increaseQuantity(index)">
                                <img src="../../assets/plus.svg" alt="plus" class="w-4">
                            </button>
                        </div>
                        <button class="grow-0 w-6 transition-all transform linear duration-300 active:scale-125"
                            @click="deleteDish(dishes.dish_id)">
                            <img src="../../assets/trash.svg" alt="" class="w-full">
                        </button>
                    </div>
                </div>
                <div class="flex items-center pl-2">
                    <p class="shrink-0 font-bold">Ghi chú:</p>
                    <input v-model="dishes.dish_note"
                        class="bg-primary rounded-b-lg mt-1 w-full h-fit px-2 pb-2 focus:outline-none">
                </div>
            </div>
        </div>
        <div class="col-start-5 col-span-3 row-start-10 flex items-center justify-center">
            <button class="btn btn-primary my-1 w-full text-white" @click="confirm()"
                :class="tableDish.length < 1 ? 'btn-disabled' : ''">
                Xác Nhận Thêm Món
            </button>
        </div>
        <div class="col-start-9 col-span-4 flex flex-col justify-end font-bold text-primary text-xl gap-2">
            <p class="pl-3">Đơn hàng đã xác nhận ({{ dishLength }} món)</p>
            <hr class=" w-3/4 ">
        </div>
        <div class="col-start-9 col-span-4 row-start-2 row-span-7 mt-4 px-3 font-medium text-lg overflow-auto">
            <div v-for="(dishes, index) in tableBill" class="flex justify-between mb-2 border-b border-primary">
                <p class=" w-3/5">
                    <span>{{ dishes.BillDetail_Dish.Dish_food.Food_name + " " }}</span>
                    <span
                        :class="dishes.BillDetail_Dish.Dish_cooking_method.Cooking_method_name == 'nước' ? 'hidden' : ''">
                        {{ dishes.BillDetail_Dish.Dish_cooking_method.Cooking_method_name }}
                    </span>
                </p>
                <p class="w-[10%] text-start">x{{ dishes.BillDetail_quantity }}</p>
                <p class="w-[30%] font-bold text-end">{{ formatPrice(dishes.BillDetail_price *
                    dishes.BillDetail_quantity) }}đ
                </p>
            </div>
        </div>
        <div class="col-start-9 col-span-4 row-start-9 row-span-full px-6 flex flex-col justify-center">
            <div class="flex gap-4 justify-end mr-4 border-b border-black font-bold text-xl">
                <p>Tổng tiền: </p>
                <p>{{ formatPrice(total) }}VNĐ</p>
            </div>
            <button class="btn btn-primary text-white font-bold text-xl mt-4 disabled:bg-secondary"
                :disabled="total === 0" @click="pay()">
                Thanh Toán
            </button>
        </div>
    </div>
    <dialog id="pay" class="modal">
        <form class="modal-box">
            <h3 class="font-bold text-lg">Chọn phương thức và xác nhận thanh toán</h3>
            <p class="py-4">
            <div class="flex justify-center gap-20 mt-2">
                <div class="flex gap-2">
                    <input type="radio" name="radio-3" class="radio radio-secondary" checked />
                    <p class="font-bold text-lg">Tiền Mặt</p>
                </div>
                <div class="flex gap-2 text-lg">
                    <input type="radio" name="radio-3" class="radio radio-secondary" />
                    <p class="font-bold">Chuyển Khoản</p>
                </div>
            </div>
            </p>
            <div class="modal-action border-t border-black pt-4 mt-0">
                <form method="dialog">
                    <button class="btn btn-primary text-white mx-2" @click="checkBill()">Xác Nhận</button>
                    <button class="btn btn-error text-white">Close</button>
                </form>
            </div>
        </form>
    </dialog>
    <dialog id="confirm" class="modal">
        <form class="modal-box">
            <h3 class="font-bold text-lg">Xác nhận thêm món</h3>
            <p class="py-4">
                Bạn có chắc chắn muốn thêm món này vào đơn hàng?
            </p>
            <div class="modal-action border-t border-black pt-4 mt-0">
                <form method="dialog">
                    <button class="btn btn-primary text-white mx-2" @click="addOrders()">Xác Nhận</button>
                    <button class="btn btn-error text-white">Close</button>
                </form>
            </div>
        </form>
    </dialog>

    <dialog id="error" class="modal">
        <div class="modal-box text-center">
            <h3 class="text-lg font-bold text-orange-500">In hóa đơn thất bại</h3>
            <p class="py-4">
                Hãy kiểm tra xem tất cả món ăn của bàn đã được hoàn tất hoặc nếu không còn cần thì hãy hủy món!
            </p>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button></button>
        </form>
    </dialog>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { RouterLink, useRoute, useRouter } from "vue-router";
import { formatPrice, getCookie, checkLogin } from "../../api/functions";
import { getMenu, getTableCurrentBill, addOrderItems, checkBillDetail } from "../../api/tableDetail";

checkLogin();

const router = useRouter();
const route = useRoute();
const id = route.params.id;
const total = ref(0);
const dishLength = ref(0);
const tableDish = ref([]);
const menu = ref([]);
const tableBill = ref([]);
const table = ref('');

onMounted(async () => {
    getMenu(id).then((res) => {
        menu.value = res;
    });
});
function loadData() {
    let data = [];
    getTableCurrentBill(id).then((res) => {
        if (!res.Table_bill) return;
        table.value = res.Table_number;
        res.Table_bill.Bill_detail.forEach((dish) => {
            const index = data.findIndex((item) => item.BillDetail_Dish.Dish_id === dish.BillDetail_Dish.Dish_id);
            if (index === -1) {
                data.push(dish);
            } else {
                data[index].BillDetail_quantity += dish.BillDetail_quantity;
            }
        });
        tableBill.value = data;
        dishLength.value = tableBill.value.length;
        total.value = res.Table_bill.Bill_total;
    });
}
loadData();

function checkBill() {
    const error = document.getElementById("error");
    checkBillDetail(id).then((res) => {
        if(res.data.message === 'invalid') {
            error.showModal();
            // console.log('invalid');
        } else {
            router.push(`/staff/checkout/${id}`);
        }
    });
}

function confirm() {
    const dialog = document.getElementById("confirm");
    dialog.showModal();
}

function pay() {
    const dialog = document.getElementById("pay");
    dialog.showModal();
}

async function addDish(category, food, dish) {
    const dishDuplicate = tableDish.value.find((d) => d.dish_id === dish);
    if (dishDuplicate) {
        dishDuplicate.dish_quantity++;
        return;
    }
    const selectedCategory = menu.value.find((cate) => cate.Category_id === category);
    if (selectedCategory) {
        const selectedFood = selectedCategory.Foods.find((item) => item.Food_id === food);
        const selectedDish = selectedFood.Dishes.find((item) => item.Dish_id === dish);
        if (selectedDish && selectedCategory) {
            const method = selectedDish.Dish_cooking_method.Cooking_method_name == "nước" ? "" : selectedDish.Dish_cooking_method.Cooking_method_name;
            const dish = {
                dish_name: selectedFood.Food_name + " " + method,
                dish_price: selectedFood.Food_price + selectedDish.Dish_additional_price,
                dish_quantity: 1,
                dish_id: selectedDish.Dish_id,
                dish_note: "",
            }
            tableDish.value.push(dish);
        }
    }
}

function increaseQuantity(index) {
    tableDish.value[index].dish_quantity++;
}

function decreaseQuantity(index) {
    if (tableDish.value[index].dish_quantity > 1) {
        tableDish.value[index].dish_quantity--;
    }
}

function deleteDish(id) {
    tableDish.value = tableDish.value.filter((dish) => dish.dish_id !== id);
}

async function addOrders() {
    let table_id = id;
    let dishes = [];
    let user_id = getCookie('Id');
    let branch_id = getCookie('Branch_id');

    tableDish.value.forEach((dish) => {
        dishes.push({
            dish_id: dish.dish_id,
            price: dish.dish_price,
            quantity: dish.dish_quantity,
            note: dish.dish_note,
        });
    });
    const result = await addOrderItems(table_id, branch_id, user_id, ...dishes)
    if (result.status === 200) {
        tableDish.value = [];
        loadData();
    }
}
</script>