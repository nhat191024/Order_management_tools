<template>
  <div class="grid grid-rows-12 w-dvw h-dvh">
    <!-- Start navbar -->
    <nav
      class="bg-primary row-span-1 flex items-center justify-between px-4 rounded-b-lg"
    >
      <img
        class="rounded-full w-14 h-14"
        src="/src/assets/logo.jpg"
        alt="Logo"
      />
      <p class="text-white text-2xl font-semibold">Bàn {{ id }}</p>
    </nav>
    <!-- End navbar -->

    <!-- Start Thanh menu món ăn -->
    <div
      role="tablist"
      class="tabs tabs-bordered row-span-1 flex items-center overflow-auto"
    >
      <a
        v-for="(tab, index) in category"
        role="tab"
        class="tab h-3/5 font-medium transition-all transform linear duration-500"
        :href="'#' + tab.id"
        :class="tabStatus[index].status ? 'tab-active text-primary' : ''"
        @click="tabChange(tab.id)"
      >
        {{ tab.name }}
      </a>
    </div>
    <!-- End Thanh menu món ăn -->

    <!-- Start Danh sách món ăn -->
    <div class="row-span-9 px-3 flex flex-col overflow-auto scroll-smooth">
      <div
        v-for="category in menu"
        :id="category.Category_id"
        class="flex flex-col mb-4 pb-4 border-b border-gray-400"
      >
        <p class="text-xl font-medium mb-4">
          {{ category.Category_name }} ({{ category.Foods.length }})
        </p>
        <div class="flex flex-col gap-4 pb-4">
          <div
            v-for="food in category.Foods"
            class="w-full h-24 grid grid-rows-3 grid-cols-12 text-lg font-light"
          >
            <img
              src="../../assets/demo.jpg"
              alt="demo"
              class="row-span-full col-span-3 w-full h-full rounded-lg"
            />
            <p class="col-start-4 col-span-full row-span-1 pl-3">
              {{ food.Food_name }}
            </p>
            <p class="col-start-4 col-span-full row-span-1 pl-3 text-sm">
              {{ food.Dishes.Dish_note }}
            </p>
            <p class="text-gray-500 pl-3 col-span-4">
              {{ formatPrice(food.Food_price) }}đ
            </p>
            <button
              @click="
                food.Dishes.length > 1
                  ? DetailDish(food.Food_id)
                  : addDish(food.Food_id)
              "
              class="col-start-12 flex justify-center items-center bg-primary rounded-lg m-px transition-all transform linear duration-300 active:scale-110"
            >
              <img src="../../assets/plus-white.svg" alt="" class="w-10/12" />
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Danh sách món ăn -->

    <!-- Start nút giỏ hàng -->
    <button
      class="flex bg-white border-t-4 items-center justify-center dropdown dropdown-top"
      @click="showCart()"
    >
      <img src="/src/assets/Vector.svg" alt="Cart" class="h-10" />
      <span
        class="rounded-full bg-primary self-start px-1 mt-1 -ml-4 text-white border border-white"
      >
        {{ totalDish() < 10 ? "0" + totalDish() : totalDish() }}
      </span>
    </button>
    <!-- End nút giỏ hàng -->

    <!-- Start Nút đóng phần thêm món ăn -->
    <dialog id="dishDetail" class="modal modal-bottom">
      <form method="dialog" class="modal-backdrop">
        <button>close</button>
      </form>
      <div class="modal-box p-0">
        <form method="dialog">
          <button
            class="btn btn-md btn-circle btn-ghost absolute right-2 top-2"
          >
            ✕
          </button>
        </form>
        <!-- Start Nút đóng phần thêm món ăn -->

        <!-- Start Thêm món ăn -->
        <div>
          <h3 class="font-bold text-xl text-center pt-2">Thêm món ăn</h3>
          <div class="flex flex-col">
            <div
              class="w-full h-24 grid grid-rows-3 grid-cols-12 text-lg font-light my-5 px-4"
            >
              <img
                src="../../assets/demo.jpg"
                alt="demo"
                class="row-span-full col-span-3 w-full h-full rounded-lg"
              />
              <p class="col-start-4 col-span-full row-span-1 pl-3">
                {{ dishDetail.Food_name }}
              </p>
              <p class="text-gray-500 pl-3 col-span-4 row-start-3">
                {{ formatPrice(dishDetail.Food_price) }}đ
              </p>
              <div
                class="col-start-10 col-span-full row-start-3 place-self-center w-full h-full flex items-center gap-3"
              >
                <!-- Start Nút - -->
                <button
                  @click="tempQuantity--"
                  class="join-item outline outline-1 p-1 outline-primary rounded-l-full transition-all transform linear duration-300 active:scale-125"
                >
                  <img src="../../assets/minus.svg" alt="" class="w-4" />
                </button>

                <p class="join-item">{{ tempQuantity }}</p>

                <!-- End Nút - -->

                <!-- Start Nút + -->
                <button
                  @click="tempQuantity++"
                  class="join-item bg-primary p-1 rounded-r-full transition-all transform linear duration-300 active:scale-125"
                >
                  <img
                    src="../../assets/plus-white.svg"
                    alt="plus"
                    class="w-4"
                  />
                </button>
                <!-- End Nút + -->
              </div>
            </div>
          </div>
          <!-- End Thêm món ăn -->

          <!-- Start Chọn cách chế biến !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!fixed -->
          <div>
            <div class="bg-stone-200 px-4 py-2">
              <p>Cách chế biến (chọn 1)</p>
            </div>
            <div class="flex flex-col">
              <div
                v-for="cookingMethod in dishDetail.Dishes"
                class="flex flex-col border-b border-gray-300 px-4 py-2"
              >
                <p class="text-black font-medium">
                  {{ cookingMethod.Dish_cooking_method.Cooking_method_name }}
                </p>
                <div class="flex justify-between">
                  <p class="text-gray-500">
                    {{ formatPrice(cookingMethod.Dish_additional_price) }}đ
                  </p>
                  <input
                    type="radio"
                    name="cookingMethods"
                    v-model="tempCookingMethod"
                    :value="cookingMethod.Dish_cooking_method.Cooking_method_id"
                    class="radio border-primary radio-primary"
                  />
                </div>
              </div>
            </div>
          </div>
          <!-- End Chọn cách chế biến -->

          <!-- Start Ghi chú -->
          <div>
            <div class="my-2">
              <label for="" class="px-4">Ghi Chú:</label>
              <textarea
                class="outline-none w-full textarea-md py-1"
                placeholder="📝Ghi chú cho quán"
                v-model="tempNote"
              ></textarea>
            </div>
          </div>
          <!-- End Ghi chú -->
        </div>

        <!-- Start Nút thêm vào giỏ hàng -->
        <div>
          <div class="modal-action p-4 mt-0 border-t-2 border-grey-400">
            <form method="dialog" class="w-full">
              <button
                :class="tempCookingMethod == 0 ? 'btn-disabled' : ''"
                class="btn-secondary btn w-full"
                @click="addDish()"
              >
                Thêm vào giỏ hàng
              </button>
            </form>
          </div>
        </div>
        <!-- End Nút thêm vào giỏ hàng -->
      </div>
    </dialog>

    <!-- Start Nút đóng phần thêm giỏ hàng -->
    <dialog id="cart" class="modal modal-bottom">
      <form method="dialog" class="modal-backdrop">
        <button>close</button>
      </form>
      <div class="modal-box p-0">
        <form method="dialog">
          <button
            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
          >
            ✕
          </button>
        </form>
        <!-- Start Giỏ hàng -->
        <div>
          <h3 class="font-bold text-xl text-center pt-2">Giỏ hàng</h3>
          <div class="flex flex-col">
            <div
              v-for="dish in billTemp"
              class="w-full h-24 grid grid-rows-4 grid-cols-12 text-lg font-light my-5 px-4"
            >
              <img
                src="../../assets/demo.jpg"
                alt="demo"
                class="row-span-full col-span-3 w-full h-full rounded-lg"
              />
              <p class="col-start-4 col-span-full row-span-1 pl-3">
                {{ dish.dishName }}
              </p>
              <p class="col-start-4 col-span-full pl-3 text-sm text-gray-500">
                {{ cookingMethodName(dish.dishId, dish.cookingMethod) }}
              </p>
              <input
                class="pl-3 row-start-3 col-start-4 col-span-full outline-none"
                placeholder="Ghi chú"
                v-model="dish.note"
              />
              <p class="text-gray-500 pl-3 col-span-4 row-start-4">
                {{ formatPrice(dish.price) }}đ
              </p>
              <div
                class="col-start-10 col-span-full row-start-4 place-self-center w-full h-full flex items-center gap-3"
              >
                <button
                  @click="dishDelete(dish.dishId)"
                  class="join-item outline outline-1 p-1 outline-primary rounded-l-full transition-all transform linear duration-300 active:scale-125"
                >
                  <img src="../../assets/minus.svg" alt="" class="w-4" />
                </button>
                <p class="join-item">{{ dish.quantity }}</p>
                <button
                  @click="dish.quantity++"
                  class="join-item bg-primary p-1 rounded-r-full transition-all transform linear duration-300 active:scale-125"
                >
                  <img
                    src="../../assets/plus-white.svg"
                    alt="plus"
                    class="w-4"
                  />
                </button>
              </div>
            </div>
          </div>
          <div
            class="flex justify-between px-4 py-2 text-lg border-t border-grey-400"
          >
            <p>Tổng cộng :</p>
            <p class="text-primary font-medium">
              {{ formatPrice(tempTotal()) }}đ
            </p>
          </div>
          <div class="modal-action p-4 mt-2 border-t-2 border-grey-400">
            <button class="btn-secondary btn w-full">Đặt món</button>
          </div>
        </div>
        <!-- End Giỏ hàng -->
      </div>
    </dialog>
    <!-- End Nút đóng phần thêm giỏ hàng -->
  </div>
</template>

<!-- Start Script -->
<script setup>
import { getMenuData } from "../../api/customer";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

// import data from "../../data/menu.json";

const route = useRoute();
const id = route.params.id;
const tabStatus = ref([]);
const category = ref([]);
const tempQuantity = ref(1);
const tempCookingMethod = ref("");
const tempNote = ref("");
const billTemp = ref([]);
const dishDetail = ref({});

const menu = ref({});

onMounted(async () => {
  getMenuData().then((res) => {
    menu.value = res;

    // Đang không lấy được cooking method, và name

    // area.value = res.Bill_table.Table_branch.Branch_name;
    // table.value = res.Bill_table.Table_number;
    // time_in.value = res.Bill_time_in;
    // total.value = formatPrice(res.Bill_total);
    // billItems.value = res.Bill_detail;

    // tabStatus.value = res.Bill_table.Table_branch.Branch_name;

    // category.value = res.Category_name;
    // const resp = res;
    // console.log(res);
    if (res.length > 0) {
      res.forEach((item) => {
        category.value.push({ id: item.Category_id, name: item.Category_name });
        // console.log(item.Category_name);
      });
    }
    pushTabStatus(res);
  });
});

// done
function pushTabStatus(res) {
  res.forEach((item) => {
    if (item.Category_id === 1) {
      tabStatus.value.push({ id: item.Category_id, status: true });
    } else tabStatus.value.push({ id: item.Category_id, status: false });
  });
}

// done
function tabChange(id) {
  tabStatus.value.forEach((item) => {
    if (item.id === id) {
      item.status = true;
    } else {
      item.status = false;
    }
  });
}

function totalDish() {
  let total = 0;
  billTemp.value.forEach((item) => {
    total += item.quantity;
  });
  return total;
}

// done
function DetailDish(id) {
  const dish = menu.value
    .flatMap((item) => item.Foods)
    .find((item) => item.Food_id === id);
  console.log(dish);
  dishDetail.value = dish;
  showDishDetail();
}

//done
function showDishDetail() {
  const dishDetail = document.getElementById("dishDetail");
  dishDetail.showModal();
}

// done
function addDish(id) {
  console.log("start");
  if (Object.keys(dishDetail.value).length === 0) {
    const dish = menu.value
      .flatMap((item) => item.Foods)
      .find((item) => item.Food_id === id);
    dishDetail.value = dish;
  }
  const checkDup = billTemp.value.find(
    (item) => item.dishId === dishDetail.value.Dish_id
  );

  if (checkDup && checkDup.cookingMethod === tempCookingMethod.value) {
    checkDup.quantity += tempQuantity.value;
    return;
  }

  console.log(dishDetail.value.id);

  //check this b
  billTemp.value.push({
    dishId: dishDetail.value.id,
    dishName: dishDetail.value.name,
    price: dishDetail.value.price,
    quantity: tempQuantity.value,
    cookingMethod: tempCookingMethod.value,
    note: tempNote.value,
  });

  dishDetail.value = {};
  tempQuantity.value = 1;
  tempCookingMethod.value = "";
  tempNote.value = "";
}

// done
function cookingMethodName(id, methodId) {
  if (methodId == "") return;
  const dish = menu.value
    .flatMap((item) => item.Foods)
    .find((item) => item.Food_id === id);

  const cookingMethod = dish.find((item) => item.Food_id === methodId);
  return cookingMethod.cookingMethodName;
}

//done
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

function formatPrice(price) {
  if (price == null) return;
  return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
</script>
<!-- End Script -->
