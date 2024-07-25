<template>
    <!-- <div class="flex flex-row flex-wrap w-full h-60">
        <div class="w-1/4  bg-teal-400 p-5 text-center">Element 1</div>
        <div class="w-1/4 self-center hover:self-center bg-rose-400 p-5 text-center">Element 2</div>
        <div class="w-1/4 hover:self-end bg-orange-400 p-5 text-center">Element 3</div>
        <div class="w-1/4 self-center hover:self-stretch bg-cyan-400 p-5 text-center">Element 4</div>
    </div> -->

    <Card class="h-96">
        <template #title>
            <div class="text-center">
                Code Playground
            </div>
        </template>
        <template #content>
            <div class="text-center">
                <InputText v-model="inputStudent" />
                <Button @click="addNewStudent" v-model="inputStudent" class="ml-2" label="Add Student" icon="pi pi-plus" />
                <ul class="mt-5">
                    <li v-for="(student, index) in students" :key="index">
                        {{ student }}
                    </li>
                </ul>
            </div>

            <TestForm class="mt-2" @submit="handleSubmit" />
        </template>
    </Card>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'

// components
import TestForm from '@/Components/Forms/TestForm.vue'

type people = {
    name: string
    age: number
    id: string | number 
    isTransfer: boolean
}

let number: number[];
let students = ref<string[]>([]);
let inputStudent = ref<string>('');
let studentDetails: object;

const isValid = (name: String) : String => {
    console.log(name)
    return name;
}

const addNewStudent = (): void => {
    students.value.push(inputStudent.value);
    inputStudent.value = '';
}

const handleSubmit = (data: Object) => {
    console.log('Na submit');
    console.log(data);
}


onMounted(() => {
    number = [56, 75, 35];
    students.value = ['James Patter', 'Juanino Nino', 'Joseph Alarcon']

    studentDetails = {
        name: 'Joseph Santos',
        age: 23,
        id: 455,
        isTransfer: true
    }

    isValid('John Johnson');
})

</script>

<style scoped>

</style>