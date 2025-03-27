<template>
    <div>
        <button
            class="fixed top-2 right-2 z-50 p-1 bg-primary text-white rounded-lg shadow-lg hover:bg-blue-600 hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
            @click="handleClick">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </div>

    <!-- Open the modal using ID.showModal() method -->
    <dialog id="my_modal_2" class="modal">
        <div class="modal-box w-11/12 max-w-6xl">
            <h3 class="text-lg font-bold">Lịch sử bếp</h3>
            <p class="py-4">Bấm vào bất kỳ đâu ngoài hộp thoại để đóng</p>

            <!-- DaisyUI table to display history items -->
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên món</th>
                            <th>Số lượng</th>
                            <th>Vị trí bàn</th>
                            <th>Đơn tạo vào lúc</th>
                            <th>Ghi chú</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        <tr v-for="(item, index) in list" :key="item.id" class="hover">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.table }}</td>
                            <td>{{ new Date(item.created_at).toLocaleString() }}</td>
                            <td>{{ item.note || 'No note' }}</td>
                            <td>
                                <button class="btn btn-primary" @click="restoreItem(item.id)">Khôi phục</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Show message if no items -->
            <div v-if="historyItems.length === 0" class="text-center py-4">
                Hiện không có lịch sử bếp.
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>đóng</button>
        </form>
    </dialog>
</template>

<script setup>
import { defineProps, computed } from 'vue';

const props = defineProps({
    historyItems: {
        type: Array,
        required: true,
        default: () => [],
    }
});

const list = computed(() => props.historyItems);

const emit = defineEmits(['click', 'restore']);

function handleClick() {
    emit('click');
    document.getElementById("my_modal_2").showModal();
}

function restoreItem(billDetailId) {
    emit('restore', billDetailId);
    document.getElementById("my_modal_2").close();
}
</script>