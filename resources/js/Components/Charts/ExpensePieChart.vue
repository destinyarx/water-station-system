
<template>
    <div class="card flex justify-center">
        <Chart type="pie" :data="chartData" :options="chartOptions" class="w-full md:w-[30rem]" />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const chartData = ref();
const chartOptions = ref();
const loading = ref(false);

const setChartData = () => {
    const documentStyle = getComputedStyle(document.body);

    return {
        labels: ['A', 'B', 'C'],
        datasets: [
            {
                data: [540, 325, 702],
                backgroundColor: [documentStyle.getPropertyValue('--p-cyan-500'), documentStyle.getPropertyValue('--p-orange-500'), documentStyle.getPropertyValue('--p-gray-500')],
                hoverBackgroundColor: [documentStyle.getPropertyValue('--p-cyan-400'), documentStyle.getPropertyValue('--p-orange-400'), documentStyle.getPropertyValue('--p-gray-400')]
            }
        ]
    };
};

const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--p-text-color');

    return {
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true,
                    color: textColor
                }
            }
        }
    };
};

const initExpensePieChart = async () => {
    chartData.value = setChartData();

    return;

    const response = await axios.get(route(''));

    if (Response.error) {
        console.log(response.error);
        console.log('Error when fetching chart data.')
    }

    chartData.value = setChartData(response.data);
}

onMounted(() => {
    chartOptions.value = setChartOptions();
    initExpensePieChart();
});
</script>
