<template>
  <nav class="bg-primary h-30">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex min-h-20 items-center justify-between">
        <div
          class="relative align-middle left-2 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0"
        >
          <div class="flex flex-shrink-0">
            <img src="/src/assets/backButton.svg" alt="Logo" />
          </div>
        </div>
        <div
          class="absolute right-2 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0"
        >
          <img src="/src/assets/table.svg" alt="" />
          <p class="text-white text-2xl font-semibold">Bàn 1</p>
        </div>
      </div>
    </div>
  </nav>
  <div class="flex justify-center m-2 text-3xl">
    <h1>Xác nhận đơn hàng</h1>
  </div>

  <div>
    <div class="overflow-y-scroll ...">
      <hr class="my-5" />
      <div class="flex ...">
        <div class="flex-none w-14 h-14 ms-1">
          <img
            src="/src/assets/logo.jpg"
            alt=""
            width="100%"
            class="rounded-lg"
          />
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
      <hr class="my-5" />
      <div class="flex ...">
        <div class="flex-none w-14 h-14 ms-1">
          <img
            src="/src/assets/logo.jpg"
            alt=""
            width="100%"
            class="rounded-lg"
          />
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
      <hr class="my-5" />
      <div class="flex ...">

        <div class="flex-none w-14 h-14 ms-1">
          <img
            src="/src/assets/logo.jpg"
            alt=""
            width="100%"
            class="rounded-lg"
          />
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
    <hr class="my-5" />
    <div class="my-5">
      <span class="text-3xl">Tổng cộng :</span>
      <span class="float-right me-2 text-3xl"
        ><p style="color: #ff5c00">170.000Đ</p></span
      >
    </div>
    <div class="grid grid-cols-2 gap-1">
      <button class="btn btn-outline m-2 outline outline-primary">
        <p style="color: #ff5c00">Chuyển khoản</p>
      </button>
      <button class="btn btn-outline m-2 outline outline-primary">
        <p style="color: #ff5c00">Tiền mặt</p>
      </button>
    </div>
    <div class="grid grid-cols-1 m-2 my-5">
      <button class="btn btn-primary">
        <p style="color: white">Thanh toán</p>
      </button>
    </div>
  </div>
</template>
