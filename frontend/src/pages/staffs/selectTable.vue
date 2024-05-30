<template>
    <div class="grid grid-cols-12 grid-rows-8 gap-5 h-screen w-screen ">
        <div class="row-span-1 col-span-2 w-full h-full flex min-h-fit items-center justify-center ">
            <button class="items-center bg-white drop-shadow-2x   text-black inline-flex">
                <img src="./../../assets/back-icon.svg" alt="My SVG Icon" class="w-10 h-10 m-3 drop-shadow-2xl">
                <span class="text-xl drop-shadow">Trở về</span></button>
        </div>
        <div class="row-span-1 col-span-6 w-full h-full flex min-h-fit overflow-auto">
            <div v-for="area in areaList" class="w-full h-full min-h-fit flex items-center justify-center">
                <button @click="" :class="mainColor" class=" m-3 drop-shadow-2x py-2 px-8 mx-2 rounded-md shadow-xl text-white font-extrabold">
                    {{(areaList.indexOf(area) + 1) }}
                </button>
            </div>
        </div>
        <div class="row-span-1 col-start-9 col-span-4 min-h-fit flex">
            <div class="w-full h-full min-h-fit m-1 flex items-center justify-center">
                <div :class="disabled" class="w-8 h-8 mr-2 rounded-full drop-shadow-sm"></div>
                <span class="text-xl drop-shadow-sm font-bold text-black">Bàn trống</span>
            </div>
            <div class="w-full h-full min-h-fit m-1 flex items-center justify-center">
                <div :class="mainColor" class="w-8 h-8 mr-2 rounded-full drop-shadow-sm"></div>
                <span class="text-xl drop-shadow-sm font-bold text-black">Bàn có khách</span>
            </div>
        </div>
        <div class="row-span-7 col-span-12 overflow-auto">
            <div class="grid grid-row-4 grid-cols-5 gap-9 ml-10">
                <div  v-for="table in tableList" >
                    <div @click="" :class="[
                            {
                                [mainColor]:table.status===1
                            },
                            {
                                [disabled]:table.status!==1
                            },
                        ]"
                        class="w-52 h-52 rounded-xl flex flex-col items-center justify-centerdrop-shadow-sm">
                            <img src="./../../assets/sofa.svg" alt="My SVG Icon" class="w-3/4 p-5 rounded-xl">
                        <span class="text-black font-extrabold pb-5 text-xl">{{ table.tableName }}</span>
                        <!-- <span class="text-black font-extrabold">{{ table.status }}</span> -->
                    </div>
                </div>
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
        // hmmm ...
    }
}
</script>