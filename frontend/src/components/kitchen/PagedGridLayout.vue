<template>
    <div class="w-full">
        <div class="flex justify-center mb-3 space-x-2">
            <button v-for="page in totalPages" :key="page" @click="goToPage(page - 1)"
                class="w-3 h-3 rounded-full transition-colors duration-200"
                :class="currentPage === page - 1 ? 'bg-green-500' : 'bg-gray-300'" aria-label="Go to page">
            </button>
        </div>
        <div class="relative overflow-hidden rounded-[32px]" @touchstart.passive="handleTouchStart" @touchmove.passive="handleTouchMove"
            @touchend.passive="handleTouchEnd">
            <div class="flex transition-transform duration-300 ease-in-out"
                :style="{ transform: `translateX(-${currentPage * 100}%)` }">
                <div v-for="(page, pageIndex) in paginatedItems" :key="pageIndex" class="w-full flex-shrink-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-1 place-items-center">
                        <div v-for="(item, index) in page"
                        class="flex flex-col items-center p-3 m-2 text-center text-white rounded-[32px] shadow-lg w-64 relative"
                        :style="{ backgroundColor: getItemColor(item) }">
                            <div class="text-xl font-bold w-full flex justify-between gap-2" style="place-content: center;">
                                <span>{{ index + 1 }}.</span>
                                <span>Bàn {{ item.table }}</span>
                            </div>
                            <div class="w-full border-t border-white"></div>
                            <div class="text-lg font-bold mt-3">{{ item.quantity }}x {{ item.name }}</div>
                            <div class="w-full my-2 border-t border-white"></div>
                            <div class="text-lg">{{ item.note ? item.note : 'Không có ghi chú' }}</div>
                            <div class="flex items-center gap-5 justify-end w-full mt-2">
                                <div class="flex items-center justify-center min-w-12 h-12 p-2 bg-white rounded-full"
                                    @click="sendCancel(item.id)">
                                    <img src="./../../assets/xmark.svg" alt="Check Icon" />
                                </div>
                                <div class="flex items-center justify-center min-w-12 h-12 p-2 bg-white rounded-full"
                                    @click="sendConfirm(item.id)">
                                    <img src="./../../assets/check.svg" alt="Check Icon" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onBeforeUnmount } from 'vue';
import { defineEmits } from 'vue';

const emit = defineEmits(['on-confirm', 'on-cancel']);

const currentTime = ref(Date.now());
let timer;

onMounted(() => {
  // Update the current time every second
  timer = setInterval(() => {
    currentTime.value = Date.now();
    // console.debug('Updated current time:', new Date(currentTime.value).toLocaleTimeString());
  }, 50);
});

onBeforeUnmount(() => {
  // Clean up the timer
  clearInterval(timer);
});

const getItemColor = (item) => {
  if (item.status === 'done') {
    return 'green';
  } else if (item.status === 'cancelled') {
    return 'red';
  } else {
    const createdAt = new Date(item.created_at).getTime();
    const minutesPassed = (currentTime.value - createdAt) / (1000 * 60);
    
    // Light blue for < 5 minutes
    if (minutesPassed < 5) {
      return 'hsl(195, 80%, 60%)';
    } 
    // Gradient from blue to orange between 5-10 minutes
    else if (minutesPassed < 10) {
      // Calculate percentage between 5-10 minutes
      const percentage = (minutesPassed - 5) / 5;
      // Hue: 195 (blue) to 30 (orange)
      const hue = 195 - (percentage * 165);
      return `hsl(${hue}, 80%, 60%)`;
    } 
    // Gradient from orange to red between 10-15 minutes
    else if (minutesPassed < 15) {
      // Calculate percentage between 10-15 minutes
      const percentage = (minutesPassed - 10) / 5;
      // Hue: 30 (orange) to 0 (red)
      const hue = 30 - (percentage * 30);
      // Saturation and brightness also intensify
      const saturation = 80 + (percentage * 20);
      const lightness = 60 - (percentage * 10);
      return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
    } 
    // Red with increasing intensity after 15 minutes
    else {
      const extraMinutes = Math.min(minutesPassed - 15, 15);
      const lightness = Math.max(40 - (extraMinutes), 25);
      return `hsl(0, 100%, ${lightness}%)`;
    }
  }
}

const sendConfirm = (id) => {
    emit('on-confirm', id);
};

const sendCancel = (id) => {
    emit('on-cancel', id);
};

const props = defineProps({
    items: {
        type: Array,
        required: true
    },
    itemsPerPage: {
        type: Number,
        default: 9
    },
    name: {
        type: String,
        default: ""
    },
    orderId: {
        type: String,
        default: ""
    }
});

const currentPage = ref(0);
const touchStartX = ref(0);
const touchEndX = ref(0);
const totalPages = computed(() => Math.ceil(props.items.length / props.itemsPerPage));
const isSwiping = ref(false);
const clickStartTime = ref(0);

const paginatedItems = computed(() => {
    const result = [];
    for (let i = 0; i < props.items.length; i += props.itemsPerPage) {
        result.push(props.items.slice(i, i + props.itemsPerPage));
    }
    return result;
});

const findLastNonEmptyPage = () => {
    // If there are no items, set to page 0
    if (props.items.length === 0) {
        return 0;
    }
    
    // Find the last page that has items
    return Math.min(Math.ceil(props.items.length / props.itemsPerPage) - 1, totalPages.value - 1);
};

const goToPage = (pageIndex) => {
    if (pageIndex >= 0 && pageIndex < totalPages.value) {
        currentPage.value = pageIndex;
    }
};

const goToNextPage = () => {
    if (currentPage.value < totalPages.value - 1) {
        currentPage.value++;
    }
};

const goToPrevPage = () => {
    if (currentPage.value > 0) {
        currentPage.value--;
    }
};

// Watch for changes in items and adjust the page accordingly
watch(() => props.items, (newItems, oldItems) => {
    // Get current items on this page
    const currentPageItems = paginatedItems.value[currentPage.value] || [];
    
    // If current page is empty or doesn't exist anymore, navigate to the last non-empty page
    if (!currentPageItems || currentPageItems.length === 0) {
        const lastNonEmptyPage = findLastNonEmptyPage();
        currentPage.value = lastNonEmptyPage;
    } 
    // If current page index is beyond the total pages, adjust to last page
    else if (currentPage.value >= totalPages.value) {
        currentPage.value = Math.max(0, totalPages.value - 1);
    }
}, { deep: true });

const handleTouchStart = (e) => {
    // Ignore if touch is on interactive elements
    if (e.target.closest('[role="button"]') || 
        e.target.closest('button') || 
        e.target.closest('img') || 
        e.target.closest('div[class*="rounded-full"]')) {
        return;
    }
    
    touchStartX.value = e.touches[0].clientX;
    clickStartTime.value = Date.now();
    isSwiping.value = false;
};

const handleTouchMove = (e) => {
    if (touchStartX.value === 0) return;
    
    // Set swiping flag if movement is significant
    const moveDistance = Math.abs(e.touches[0].clientX - touchStartX.value);
    if (moveDistance > 10) {
        isSwiping.value = true;
    }
    
    touchEndX.value = e.touches[0].clientX;
};

const handleTouchEnd = () => {
    // Only process swipe if we're actually swiping and not just tapping
    if (isSwiping.value) {
        const swipeThreshold = 20;
        const swipeDistance = touchEndX.value - touchStartX.value;

        if (swipeDistance > swipeThreshold) {
            goToPrevPage();
        } else if (swipeDistance < -swipeThreshold) {
            goToNextPage();
        }
    }
    
    // Reset values
    touchStartX.value = 0;
    touchEndX.value = 0;
    isSwiping.value = false;
};
</script>