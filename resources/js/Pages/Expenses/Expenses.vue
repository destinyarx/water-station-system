<template>
    <Head title="Expenses History" />

    <Layout>
        <Card class="min-h-screen">
            <template #title>
                <div>Expenses History</div>
            </template>
            <template #content>
                <div class="flex justify-end">
                    <Button @click="showForm('add')" type="button" label="Add" icon="pi pi-plus" />
                </div>
            </template>
        </Card>
    </Layout>

    <Dialog v-model:visible="visible" modal header="Add Expenses" :style="{ width: '60rem'}">
        <Card>
            <template #content>
                <ExpensesForm :form="form">
                    <div class="flex justify-end gap-2">
                        <Button type="button" label="Cancel" severity="danger" @click="visible = false"></Button>
                        <Button type="submit" label="Save" @click="submit"></Button>
                    </div>
                </ExpensesForm>
            </template>
        </Card>
    </Dialog>

    <Notification />
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useForm, Head } from "@inertiajs/vue3";
import axios from 'axios';

import Layout from '@/Layouts/Layout.vue';
import ExpensesForm from '@/Components/Forms/ExpensesForm.vue'

import Notification from '@/Components/Toast/Notification.vue';
import { alert } from '@/Composables/useNotification';
import { useToast } from 'primevue/usetoast';
const toast = useToast();

const fetchData = () => {
    console.log('Fetch Data');

    // axios.get(route('expenses.fetch'))
    //     .then(response => {

    //     })
    //     .catch(error => {

    //     })
}

// Form data
const visible = ref(false);
const form = useForm({
    'category' : null,
    'price' : null, 
    'expense_date' : null,
    'category_other' : null,
    'description' : null
});

// Form function
const showForm = (action: string) => {
    console.log(action);
    visible.value = true;
}

const resetForm = () => {
    form.category = null;
    form.price = null;
    form.expense_date = null;
    form.category_other = null;
}

const addExpenses = () => {
    axios.post(route('expenses.add'), form)
        .then(response => {
            alert(toast, 'success', 'Success!', 'Expenses successfully updated.');
            visible.value = false;
            resetForm();
            fetchData();
        })
        .catch(error => {
            console.log(error)
            alert(toast, 'error', 'Error!', 'Error when saving expenses.');
        })
}

const submit = () => {
    addExpenses();
    resetForm()
}

</script>