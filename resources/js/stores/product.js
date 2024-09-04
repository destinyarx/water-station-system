import { defineStore } from 'pinia'
import { ref } from 'vue'
 

export const useProductStore = defineStore('counter', () => {
    const containerPrices = ref(null);

    async function fetchCointanerPrices() {
        try {
            const response = await axios.get(route('products.get-container-prices'));
            let prices = {};
            let key = '';

            if (response.data) {
                response.data.forEach((price) => {
                    key = price['id'] === 1 ? 'slim_qty' : 'round_qty'
                    prices[key] = {};
            
                    prices[key]['description'] = price['description'];
                    prices[key]['price'] = price['price'];
                })
            }

            containerPrices.value = prices;
            console.log(containerPrices.value);
        } catch (error) {
            console.log('Failed to fetch container prices', error);
        }
    } 

    return { containerPrices, fetchCointanerPrices }
})