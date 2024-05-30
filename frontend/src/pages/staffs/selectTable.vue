<template>
    <div class="grid grid-cols-12 grid-rows-8 gap-5 h-screen w-screen ">
        <div class="col-span-2 flex items-center justify-center ">
            <button class="items-center bg-white drop-shadow-2x text-black inline-flex">
                <div :class="mainColor" class="w-10 h-10 m-2 drop-shadow-2xl rounded-xl p-1">
                    <img src="./../../assets/left-long-solid.svg" alt="My SVG Icon" class="">
                </div>
                <span class="text-xl drop-shadow">Trở về</span></button>
        </div>
        <div class="col-span-5 flex gap-3 items-center overflow-auto">

            <button v-for="area in areaList" @click="test" :class="mainColor"
                class="py-2 px-8 drop-shadow-2x rounded-md shadow-xl text-white font-extrabold">
                {{ (areaList.indexOf(area) + 1) }}
            </button>

        </div>
        <div class="col-start-8 col-span-4 flex">
            <div class="w-full h-full flex items-center justify-center">
                <div :class="disabled" class="w-8 h-8 mr-2 rounded-full drop-shadow-sm"></div>
                <span class="text-xl drop-shadow-sm font-bold text-black">Bàn trống</span>
            </div>
            <div class="w-full h-full flex items-center justify-center">
                <div :class="mainColor" class="w-8 h-8 mr-2 rounded-full drop-shadow-sm"></div>
                <span class="text-xl drop-shadow-sm font-bold text-black">Bàn có khách</span>
            </div>
        </div>
        <div class="row-span-7 col-start-2 col-span-10 overflow-auto mt-5 grid grid-row-4 grid-cols-5 gap-4 place-items-center">
            <div @click="test" v-for="table in tableList" :class="table.status == 1 ? mainColor : disabled" 
            class="w-40 h-40 rounded-xl flex flex-col items-center justify-center drop-shadow-sm">
                <img src="./../../assets/sofa.svg" alt="My SVG Icon" class="w-3/4 p-5 rounded-xl">
                <span class="text-black font-extrabold pb-5 text-xl">{{ table.tableName }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // đổi màu chủ đạo { mainColor: table.status === 1, disabled: table.status !== 1 }
            mainColor: 'bg-orange-500',
            disabled: 'bg-gray-300',

            // thay đổi số lượng phần tử tương ứng với số bàn 
            // (scroll dọc)
            tableList: [
                {
                    tableName: "Bàn 1",
                    status: 1
                },
                {
                    tableName: "Bàn 2",
                    status: 0
                },
                {
                    tableName: "Bàn 1",
                    status: 1
                },
                {
                    tableName: "Bàn 2",
                    status: 0
                },
                {
                    tableName: "Bàn 1",
                    status: 1
                },
                {
                    tableName: "Bàn 2",
                    status: 0
                },
                



            ],
            // thay đổi số lượng phần tử tương ứng với số lượng khu vực / nhà
            // (scroll ngang)
            areaList: [
                {
                    areaName: "Khu 1"
                },
                {
                    areaName: "Khu 2"
                },
                {
                    areaName: "Khu 3"
                },
                {
                    areaName: "Khu 4"
                },


            ]
        }
    },

    methods: {
        test() {
            console.log("test")
        }
    }
}
</script>