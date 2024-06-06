<template>
  <div class="flex justify-center">
    <h1>Xác nhận đơn hàng</h1>
  </div>

  <div>
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
    <div>
      <span>Tổng cộng :</span>
      <span class="float-right me-2"
        ><p style="color: #ff5c00">170.000Đ</p></span
      >
    </div>
    <div class="grid grid-cols-2 gap-1">
      <button class="btn btn-outline m-2 outline outline-orange-500">
        <p style="color: #ff5c00">Chuyển khoản</p>
      </button>
      <button class="btn btn-outline m-2 outline outline-orange-500">
        <p style="color: #ff5c00">Tiền mặt</p>
      </button>
    </div>
    <div class="grid grid-cols-1 my-5">
      <button class="btn bg-orange-500 m-2">
        <p style="color: white">Thanh toán</p>
      </button>
    </div>
  </div>
</template>
