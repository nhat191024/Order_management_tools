<template>
    <div class="grid grid-cols-12 grid-rows-10 gap-5 h-screen w-screen">
        <Form
            class="col-start-5 col-span-4 row-start-2 row-span-8 border border-solid bg-orange-500 rounded-xl grid grid-cols-3 grid-rows-10 gap-2">
            <img src="../../assets/logo.jpg" alt="logo" class=" rounded-full col-start-2 row-span-4 self-center">
            <Field type="text" name="username" placeholder="Tên Đăng Nhập"
                class="row-start-5 col-span-3 mx-10 mb-1 -mt-2 rounded-2xl text-center bg-white drop-shadow-2xl" />
            <Field type="password" name="password" placeholder="Mật Khẩu"
                class="row-start-6 col-span-3 mx-10 mt-1 -mb-2 rounded-2xl text-center bg-white drop-shadow-2xl" />
            <button type="submit"
                class="btn bg-orange-400 border-0 drop-shadow-lg text-white row-start-8 col-start-1 col-span-3 self-center mx-10">Đăng
                Nhập</button>
        </Form>
    </div>
</template>

<script setup>
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

</script>