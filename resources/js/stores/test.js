import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useCounterStore = defineStore('counter', () => {
    const count = ref(5)
    const name = ref('Eduardo')
    const doubleCount = computed(() => count.value * 2)
    function increment(number) {
        count.value += number
    }

    return { count, name, doubleCount, increment }
})