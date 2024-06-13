<template>
  <div class="grid grid-rows-12 w-dvw h-dvh">
    <nav class="bg-primary  top-0 left-0 w-full row-span-1 flex items-center justify-between px-4 rounded-b-lg">
    <img class="rounded-full w-14 h-14" src="/src/assets/backButton.svg" alt="Logo" />
    <p class="text-white text-2xl font-semibold">Bàn {{ }}</p>
  </nav>
      <div class="flex-auto my-3">
        <p class="text-black text-2xl font-semibold text-center">Xác nhận đơn hàng</p>
        
      </div>
  <div class="row-start-3 row-span-8 px-3 flex flex-col overflow-auto scroll-smooth">
    <div v-for="i in 10" >
      <hr class="mt-3 mb-2" />
      <div class="flex ...">
        <div class="flex-none w-14 h-14 ms-1">
          <img src="/src/assets/logo.jpg" alt="" width="100%" class="rounded-lg" />
        </div>
        <div class="grow h-14 ...">
          <div class="grid grid-cols-3">
            <span class="ms-3">1x</span>
            <span class="">Tên món</span>
            <div>
              <span class="float-right me-2">80.000Đ</span>
            </div>
            <div dir="ltr">
              <span class="ms-3">Ghi chú</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="row-start-11 bg-white "  >
    <hr class="" />
    <div class="bg-white px-2">
      <span class="text-2xl">Tổng cộng :</span>
      <span class="float-right me-2 text-2xl">
        <p style="color: #ff5c00">170.000Đ</p>
      </span>
    </div>
    <div class="grid grid-cols-1 m-2 my-3">
      <button class="btn btn-primary">
        <p style="color: white">Thanh toán</p>
      </button>
    </div>
  </footer>



</div>
</template>
