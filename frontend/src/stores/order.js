import { reactive } from 'vue';
import { defineStore } from 'pinia';

export const useOrderStore = defineStore('order', () => {
    const dishes = reactive([]);

    function addDish(dish) {
        dishes.push(dish);
    }

    function clearDishes() {
        dishes.splice(0, dishes.length);
    }

    return {
        dishes,
        addDish,
        clearDishes
    }
});