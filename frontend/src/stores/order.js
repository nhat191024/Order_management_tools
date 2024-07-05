import { reactive } from 'vue';
import { defineStore } from 'pinia';

export const useOrderStore = defineStore('order', () => {
    const dishes = reactive(JSON.parse(localStorage.getItem('dishes') || '[]'));

    function addDish(dish) {
        dishes.push(dish);
        localStorage.setItem('dishes', JSON.stringify(dishes));
    }

    function clearDishes() {
        dishes.splice(0, dishes.length);
        localStorage.setItem('dishes', JSON.stringify(dishes));
    }

    return {
        dishes,
        addDish,
        clearDishes
    }
});