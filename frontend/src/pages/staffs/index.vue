<template>
    <div class="grid grid-cols-12 grid-rows-10 gap-5 h-screen w-screen">
        <Form @submit="onSubmit"
            class="col-start-5 col-span-4 row-start-2 row-span-8 border border-solid bg-primary rounded-xl grid grid-cols-3 grid-rows-7 px-10">
            <img src="../../assets/logo.jpg" alt="logo"
                class=" rounded-full col-span-full row-span-3 self-center place-self-center w-[50%]">
            <Field type="text" name="username" placeholder="Tên Đăng Nhập"
                class="row-start-4 col-span-full h-[60%] rounded-2xl text-center bg-white drop-shadow-2xl"
                :rules="usernameRule" autocomplete="username" />
            <ErrorMessage class="col-span-full row-start-4 self-end mb-1 place-self-center font-bold text-white"
                name="username" />
            <p :class="{ 'hidden': auth === 'none' }"
                class="col-span-full row-start-4 self-end mb-1 place-self-center font-bold text-white">
                Đăng nhập thất bại</p>
            <Field type="password" name="password" placeholder="Mật Khẩu"
                class="row-start-5 col-span-full  h-[60%] rounded-2xl text-center bg-white drop-shadow-2xl"
                :rules="passwordRule" autocomplete="current-password" />
            <ErrorMessage class="col-span-full row-start-5 self-end mb-1 place-self-center text-white font-bold"
                name="password" />
            <p :class="{ 'hidden': auth === 'none' }" class=" col-span-full row-start-5 self-end mb-1 place-self-center
                text-white font-bold">
                Đăng nhập thất bại</p>
            <button type="submit"
                class="btn btn-secondary border-0 drop-shadow-lg text-white row-start-6 row-span-2 col-span-3 self-center">
                Đăng Nhập
            </button>
        </Form>
    </div>
</template>

<script setup>
import { loginHandle } from '../../api/login';
import { ref } from 'vue';
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

const usernameRule = yup.string().required('Tên Đăng Nhập là bắt buộc');
const passwordRule = yup.string().required('Mật khẩu là bắt buộc').min(4, 'Mật khẩu phải có ít nhất 4 ký tự');
const auth = ref('none');

async function onSubmit(values) {
    await loginHandle(values.username, values.password)
        .then(res => {
            if (res.message === 'success') {
                auth.value = 'none';
                switch (res.role) {
                    case 2:
                        window.location.href = '/staff/table';
                        break;
                    case 3:
                        window.location.href = '/staff/kitchen';
                        break;
                    default:
                        auth.value = 'fail';
                        break;
                }
            }
        })
}
</script>