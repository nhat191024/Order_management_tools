<template>
    <div class="grid grid-cols-12 grid-rows-10 gap-5 h-screen w-screen">
        <p class="col-start-2 col-span-4 row-start-2 row-auto self-center font-extrabold text-black text-4xl">
            Đăng Nhập Nhanh
        </p>
        <div class="col-start-2 col-span-4 row-start-3 row-span-7 flex flex-col gap-3 overflow-scroll">
            <div class="flex items-center gap-6 bg-primary py-2 pl-5 rounded-[20px] ">
                <img src="../../assets/logo.jpg" alt="" class="rounded-full w-1/6">
                <p class="font-bold text-white text-xl">Nguyễn Thị Nở</p>
            </div>
        </div>
        <Form
            class="col-start-8 col-span-4 row-start-2 row-span-8 border border-solid bg-primary rounded-xl grid grid-cols-3 grid-rows-7 px-10">
            <img src="../../assets/logo.jpg" alt="logo"
                class=" rounded-full col-span-full row-span-3 self-center place-self-center w-[50%]">
            <Field type="text" name="username" placeholder="Tên Đăng Nhập"
                class="row-start-4 col-span-full h-[60%] rounded-2xl text-center bg-white drop-shadow-2xl"
                :rules="usernameRule" />
            <ErrorMessage class="col-span-full row-start-4 self-end mb-1 place-self-center font-bold text-white"
                name="username" />
            <Field type="password" name="password" placeholder="Mật Khẩu"
                class="row-start-5 col-span-full  h-[60%] rounded-2xl text-center bg-white drop-shadow-2xl"
                :rules="passwordRule" />
            <ErrorMessage class="col-span-full row-start-5 self-end mb-1 place-self-center text-white font-bold"
                name="password" />
            <button type="submit"
                class="btn btn-primary border-0 drop-shadow-lg text-white row-start-6 row-span-2 col-span-3 self-center">
                Đăng Nhập
            </button>
        </Form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

const usernameRule = yup.string().required('Tên Đăng Nhập là bắt buộc');
const passwordRule = yup.string().required('Mật khẩu là bắt buộc').min(6, 'Mật khẩu phải có ít nhất 6 ký tự');

const auth = ref('none');

function onSubmit(values) {

}
</script>