<template>
    <div class="grid grid-rows-12 w-dvw h-dvh">
        <nav class="bg-primary row-span-1 flex items-center justify-between px-4 rounded-b-lg">
            <img class="rounded-full w-14 h-14" src="/src/assets/logo.jpg" alt="Logo" />
            <p class="text-white text-2xl font-semibold">Bàn {{ id }}</p>
        </nav>
        <!-- category -->
        <div role="tablist" class="tabs tabs-bordered row-span-1 flex items-center overflow-auto">
            <a v-for="(tab, index) in category" role="tab"
                class="tab h-3/5 font-medium transition-all transform linear duration-500" :href="'#' + tab.id"
                :class="tabStatus[index].status ? 'tab-active text-primary' : ''" @click="tabChange(tab.id)">
                {{ tab.name }}
            </a>
        </div>
        <!-- Menu -->
        <div class="row-span-9 px-3 flex flex-col overflow-auto scroll-smooth">
            <div v-for="category in menu" :id="category.Category_id"
                class="flex flex-col mb-4 pb-4 border-b border-gray-400">
                <p class="text-xl font-medium mb-4">
                    {{ category.Category_name }} ({{ category.Foods.length }})
                </p>
                <div class="flex flex-col gap-4 pb-4">
                    <div v-for="food in category.Foods"
                        class="w-full h-24 grid grid-rows-3 grid-cols-12 text-lg font-light">
                        <img src="../../assets/demo.jpg" alt="demo"
                            class="row-span-full col-span-3 w-full h-full rounded-lg" />
                        <p class="col-start-4 col-span-full row-span-1 pl-3">
                            {{ food.Food_name }}
                        </p>
                        <p class="col-start-4 col-span-full row-span-1 pl-3 text-sm">
                            {{ food.Dishes.length <= 1 ? food.Dishes[0].Dish_note : "" }} </p>
                                <p class="text-gray-500 pl-3 col-span-4">
                                    {{ formatPrice(food.Food_price) }}đ
                                </p>
                                <button @click="
                                    food.Dishes.length > 1
                                        ? DetailDish(food.Food_id)
                                        : addDish(food.Food_id, food.Dishes[0].Dish_cooking_method.Cooking_method_id)"
                                    class="col-start-12 flex justify-center items-center bg-primary rounded-lg m-px transition-all transform linear duration-300 active:scale-110">
                                    <img src="../../assets/plus-white.svg" alt="" class="w-10/12" />
                                </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white border-t-4 h-full flex justify-around">
            <div class="flex items-center justify-center" @click="showCart()">
                <img src="/src/assets/Vector.svg" alt="Cart" class="h-10" />
                <span class="rounded-full bg-primary self-start px-1 mt-1 -ml-4 text-white border border-white">
                    {{ totalDish() < 10 ? "0" + totalDish() : totalDish() }} </span>
            </div>
            <div class="flex items-center justify-center" @click="showOrderHistory()">
                <img src="/src/assets/list.svg" alt="Cart" class="h-10" />
                <span class="rounded-full bg-primary self-start px-1 mt-1 -ml-4 text-white border border-white">
                    {{ totalDish() < 10 ? "0" + totalDish() : totalDish() }} </span>
            </div>
        </div>

        <!-- Modal chi tiết món ăn -->
        <dialog id="dishDetail" class="modal modal-bottom">
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
            <div class="modal-box p-0">
                <form method="dialog">
                    <button class="btn btn-md btn-circle btn-ghost absolute right-2 top-2">
                        ✕
                    </button>
                </form>
                <div>
                    <h3 class="font-bold text-xl text-center pt-2">Thêm món ăn</h3>
                    <div class="flex flex-col">
                        <div class="w-full h-24 grid grid-rows-3 grid-cols-12 text-lg font-light my-5 px-4">
                            <img src="../../assets/demo.jpg" alt="demo"
                                class="row-span-full col-span-3 w-full h-full rounded-lg" />
                            <p class="col-start-4 col-span-full row-span-1 pl-3">
                                {{ dishDetail.Food_name }}
                            </p>
                            <p class="text-gray-500 pl-3 col-span-4 row-start-3">
                                {{ formatPrice(dishDetail.Food_price) }}đ
                            </p>
                            <div
                                class="col-start-10 col-span-full row-start-3 place-self-center w-full h-full flex items-center gap-3">
                                <button @click="tempQuantity--"
                                    class="join-item outline outline-1 p-1 outline-primary rounded-l-full transition-all transform linear duration-300 active:scale-125"
                                    :disabled="tempQuantity <= 1">
                                    <img src="../../assets/minus.svg" alt="" class="w-4" />
                                </button>
                                <p class="join-item">{{ tempQuantity }}</p>
                                <button @click="tempQuantity++"
                                    class="join-item bg-primary p-1 rounded-r-full transition-all transform linear duration-300 active:scale-125">
                                    <img src="../../assets/plus-white.svg" alt="plus" class="w-4" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-stone-200 px-4 py-2">
                            <p>Cách chế biến (chọn 1)</p>
                        </div>
                        <div class="flex flex-col">
                            <div v-for="cookingMethod in dishDetail.Dishes"
                                class="flex flex-col border-b border-gray-300 px-4 py-2">
                                <p class="text-black font-medium">
                                    {{ cookingMethod.Dish_cooking_method.Cooking_method_name }}
                                </p>
                                <div class="flex justify-between">
                                    <p class="text-gray-500">
                                        {{ formatPrice(cookingMethod.Dish_additional_price) }}đ
                                    </p>
                                    <input type="radio" name="cookingMethods" v-model="tempCookingMethod"
                                        :value="cookingMethod.Dish_cooking_method.Cooking_method_id"
                                        class="radio border-primary radio-primary" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="my-2">
                            <label for="" class="px-4">Ghi Chú:</label>
                            <textarea class="outline-none w-full textarea-md py-1" placeholder="📝Ghi chú cho quán"
                                v-model="tempNote"></textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="modal-action p-4 mt-0 border-t-2 border-grey-400">
                        <form method="dialog" class="w-full">
                            <button :class="tempCookingMethod == 0 ? 'btn-disabled' : ''"
                                class="btn-secondary btn w-full" @click="addDish(dishDetail.Food_id)">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </dialog>
        <!-- giỏ hàng -->
        <dialog id="cart" class="modal modal-bottom ">
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
            <div class="modal-box p-0 h-4/5">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                        ✕
                    </button>
                </form>
                <div class="h-full grid grid-rows-10">
                    <h3 class="font-bold text-xl text-center pt-2 row-start-1 place-self-center">Giỏ hàng</h3>
                    <div class="overflow-auto row-start-2 row-span-full">
                        <div v-for="dish in billTemp"
                            class="w-full h-24 grid grid-rows-4 grid-cols-12 text-lg font-light my-5 px-4">
                            <img src="../../assets/demo.jpg" alt="demo"
                                class="row-span-full col-span-3 w-full h-full rounded-lg" />
                            <p class="col-start-4 col-span-full row-span-1 pl-3">
                                {{ dish.dishName }}
                            </p>
                            <p class="col-start-4 col-span-full pl-3 text-sm text-gray-500">
                                {{ dish.cookingMethod }}
                            </p>
                            <input class="pl-3 row-start-3 col-start-4 col-span-full outline-none" placeholder="Ghi chú"
                                v-model="dish.note" />
                            <p class="text-gray-500 pl-3 col-span-4 row-start-4">
                                {{ formatPrice(dish.price) }}đ
                            </p>
                            <div
                                class="col-start-10 col-span-full row-start-4 place-self-center w-full h-full flex items-center gap-3">
                                <button @click="dishDelete(dish.dishId)"
                                    class="join-item outline outline-1 p-1 outline-primary rounded-l-full transition-all transform linear duration-300 active:scale-125">
                                    <img src="../../assets/minus.svg" alt="" class="w-4" />
                                </button>
                                <p class="join-item">{{ dish.quantity }}</p>
                                <button @click="dish.quantity++"
                                    class="join-item bg-primary p-1 rounded-r-full transition-all transform linear duration-300 active:scale-125">
                                    <img src="../../assets/plus-white.svg" alt="plus" class="w-4" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <div class="flex justify-between px-4 py-2 text-lg">
                            <p>Tổng cộng :</p>
                            <p class="text-primary font-medium">
                                {{ formatPrice(tempTotal()) }}đ
                            </p>
                        </div>
                        <div class="modal-action p-4 mt-2 border-t-2 border-grey-400">
                            <button class="btn-secondary btn w-full" @click="confirmOrder()">Đặt món</button>
                        </div>
                    </div>
                </div>
            </div>
        </dialog>

        <dialog id="orderHistory" class="modal modal-bottom ">
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
            <div class="modal-box p-0 h-4/5">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                        ✕
                    </button>
                </form>
                <div class="h-full grid grid-rows-10">
                    <h3 class="font-bold text-xl text-center pt-2 row-start-1 place-self-center">Đơn hàng đã đặt</h3>
                    <div class="overflow-auto row-start-2 row-span-full">
                        <div v-for="order in orderHistory.orders"
                            class="w-full h-24 grid grid-rows-4 grid-cols-12 text-lg font-light my-5 px-4">
                            <img src="../../assets/demo.jpg" alt="demo"
                                class="row-span-full col-span-3 w-full h-full rounded-lg" />
                            <p class="col-start-4 col-span-full row-span-1 pl-3">
                                {{ order.dishName }}
                            </p>
                            <p class="col-start-4 col-span-full pl-3 text-sm text-gray-500">
                                {{ order.cookingMethod }}
                            </p>
                            <input class="pl-3 row-start-3 col-start-4 col-span-full outline-none" placeholder="Ghi chú"
                                v-model="order.note" disabled/>
                            <p class="text-gray-500 pl-3 col-span-4 row-start-4">
                                {{ formatPrice(order.price) }}đ
                            </p>
                            <div
                                class="col-start-10 col-span-full row-start-4 place-self-center w-full h-full flex items-center gap-3">
                                <button @click="dishDelete(order.dishId)" disabled
                                    class="join-item outline outline-1 p-1 outline-primary rounded-l-full">
                                    <img src="../../assets/minus.svg" alt="" class="w-4" />
                                </button>
                                <p class="join-item">{{ order.quantity }}</p>
                                <button @click="order.quantity++" disabled
                                    class="join-item bg-primary p-1 rounded-r-full">
                                    <img src="../../assets/plus-white.svg" alt="plus" class="w-4" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 border-t border-gray-300">
                        <div class="flex justify-end gap-2 px-4 py-2 text-lg">
                            <p>Tổng cộng :</p>
                            <p class="text-primary font-medium">
                                {{ formatPrice(orderHistory.total) }}đ
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </dialog>
    </div>
</template>

<script setup>
import { getMenuData, currentOrder } from "../../api/customer";
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { formatPrice } from "../../api/functions";
import { useOrderStore } from "../../stores/order";

const orderStore = useOrderStore();
const route = useRoute();
const router = useRouter();

const id = route.params.id;

const tabStatus = ref([]);
const category = ref([]);
const tempQuantity = ref(1);
const tempCookingMethod = ref(0);
const tempNote = ref("");
const billTemp = ref([]);
const dishDetail = ref([]);
const menu = ref([]);
const orderHistory = ref([]); 


if (orderStore.dishes) {
    billTemp.value = [...orderStore.dishes];
}

onMounted(async () => {
    getMenuData().then((res) => {
        menu.value = res;
        if (res.length > 0) {
            res.forEach((item) => {
                category.value.push({ id: item.Category_id, name: item.Category_name });
            });
        }
        pushTabStatus(res);
    });
});

function pushTabStatus(res) {
    res.forEach((item) => {
        if (item.Category_id === 1) {
            tabStatus.value.push({ id: item.Category_id, status: true });
        } else tabStatus.value.push({ id: item.Category_id, status: false });
    });
}

function tabChange(id) {
    tabStatus.value.forEach((item) => {
        if (item.id === id) {
            item.status = true;
        } else {
            item.status = false;
        }
    });
}

function getCurrentOrder(id) {
    currentOrder(id).then((res) => {
        orderHistory.value = res;
    });
}
getCurrentOrder(id);

function totalDish() {
    let total = 0;
    billTemp.value.forEach((item) => {
        total += item.quantity;
    });
    return total;
}

function DetailDish(id) {
    const dish = menu.value
        .flatMap((item) => item.Foods)
        .find((item) => item.Food_id === id);
    dishDetail.value = dish;
    showDishDetail();
}

function showDishDetail() {
    const dishDetail = document.getElementById("dishDetail");
    dishDetail.showModal();
}

function showOrderHistory() {
    const orderHistory = document.getElementById("orderHistory");
    orderHistory.showModal();
}

function addDish(id, cookingMethodId) {
    let data = menu.value
        .flatMap((item) => item.Foods)
        .find((item) => item.Food_id === id);
    dishDetail.value = data;

    const checkDup = billTemp.value.find(
        (item) => item.foodId === id
    );

    tempCookingMethod.value == 0 ? tempCookingMethod.value = cookingMethodId : tempCookingMethod.value;

    if (checkDup && checkDup.cookingMethodId === tempCookingMethod.value) {
        checkDup.quantity += tempQuantity.value;
        return;
    }

    let checking = dishDetail.value.Dishes && dishDetail.value.Dishes.length > 1 ? true : false;

    if (!checking) {
        const dish = dishDetail.value.Dishes[0];
        billTemp.value.push({
            foodId: dishDetail.value.Food_id,
            dishId: dish.Dish_id,
            dishName: dishDetail.value.Food_name,
            price: dishDetail.value.Food_price + dish.Dish_additional_price,
            quantity: tempQuantity.value,
            cookingMethod: dish.Dish_cooking_method.Cooking_method_name,
            cookingMethodId: dish.Dish_cooking_method.Cooking_method_id,
            note: tempNote.value,
        });
        dishDetail.value = {};
        tempQuantity.value = 1;
        tempCookingMethod.value = "";
        tempNote.value = "";
        return;
    }
    let dish = dishDetail.value.Dishes.find(
        (item) => item.Dish_cooking_method.Cooking_method_id === tempCookingMethod.value
    );
    billTemp.value.push({
        foodId: dishDetail.value.Food_id,
        dishId: dish.Dish_id,
        dishName: dishDetail.value.Food_name + " " + dish.Dish_cooking_method.Cooking_method_name,
        price: dishDetail.value.Food_price + dish.Dish_additional_price,
        quantity: tempQuantity.value,
        cookingMethod: dish.Dish_cooking_method.Cooking_method_name,
        cookingMethodId: dish.Dish_cooking_method.Cooking_method_id,
        note: tempNote.value,
    });
    dishDetail.value = {};
    tempQuantity.value = 1;
    tempCookingMethod.value = "";
    tempNote.value = "";
}

function dishDelete(id) {
    const index = billTemp.value.find((item) => item.dishId === id);
    index.quantity--;
    if (index.quantity === 0) {
        billTemp.value = billTemp.value.filter((item) => item.dishId !== id);
    }
}

function tempTotal() {
    let total = 0;
    billTemp.value.forEach((item) => {
        total += item.price * item.quantity;
    });
    return total;
}

function showCart() {
    const cart = document.getElementById("cart");
    cart.showModal();
}

function confirmOrder() {
    orderStore.clearDishes();
    billTemp.value.forEach((item) => {
        orderStore.addDish({
            foodId: item.foodId,
            dishId: item.dishId,
            dishName: item.dishName,
            quantity: item.quantity,
            price: item.price,
            cookingMethod: item.cookingMethod,
            cookingMethodId: item.cookingMethodId,
            note: item.note,
        });
    });
    getCurrentOrder(id);
    router.push(`/orderConfirm/${id}`);
}
</script>
<!-- End Script -->
