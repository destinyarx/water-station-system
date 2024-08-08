<template>
    <Card>
        <template #content>
            <div class="card flex justify-content-center">
                <Stepper linear>
                    <StepperPanel>
                        <template #header="{ index, clickCallback }">
                            <button class="bg-transparent border-none inline-flex flex-column items-center justify-center gap-2 mb-2" @click="clickCallback">
                                <div class="flex items-center justify-center border border-1 rounded-full w-12 h-12 p-2">
                                    <i class="pi pi-user" style="font-size: 1.8rem"/>
                                </div>
                                <span>Details</span>
                            </button>
                        </template>
                        <template #content="{ nextCallback }">
                            <!-- Customer Details Form -->
                            <div class="w-100">
                                <div class="mb-2"> Name 
                                    <span class="text-rose-800">*</span>
                                </div>
                                <InputText v-model="props.form.customer.name" class="w-full" placeholder="Enter Customer Name" autocomplete="off"/>

                                <div class="mb-2 mt-4">
                                    Cellphone Number
                                    <span class="text-rose-800">*</span>
                                </div>
                                <InputNumber v-model="props.form.customer.cellphone_number" class="w-full" placeholder="Mobile Number" autocomplete="off" />

                                <div class="mb-2 mt-4">Email <small>(Optional)</small></div>
                                <InputText v-model="props.form.customer.email" class="w-full" placeholder="Enter Email Address" autocomplete="off"/>

                                <div class="mb-2 mt-4">Facebook <small>Optional</small></div>
                                <InputText v-model="props.form.customer.messenger_name" class="w-full" placeholder="Facebook Messenger Username" autocomplete="off"/>

                                <!-- <div class="mb-2 mt-4">Status</div>
                                <ToggleButton v-model="props.form.customer.status" onLabel="Active" offLabel="Inactive" /> -->

                                <div class="flex justify-end mt-5">
                                    <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="validateForm('customer', nextCallback)" />
                                </div>
                            </div>
                        </template>
                    </StepperPanel>

                    <StepperPanel>
                    <template #header="{ index, clickCallback }">
                            <button class="bg-transparent border-none inline-flex flex-column items-center justify-center gap-2 mb-2" @click="clickCallback">
                                <div class="flex items-center justify-center border border-1 rounded-full w-12 h-12 p-2">
                                    <i class="pi pi-home" style="font-size: 1.8rem"/>
                                </div>
                                <span>Address</span>
                            </button>
                        </template>

                        <!-- Address Form -->
                        <template #content="{ prevCallback, nextCallback }">
                            <div class="w-100">
                                <div class="mb-4">
                                    <div>House Description</div>
                                    <Textarea v-model="form.address.description" autoResize  rows="4" cols="30" class="w-full" placeholder="Provide Description About the Delivery Address"/>
                                </div>

                                <div class="grid grid-cols-5 gap-5 my-4">
                                    <div>
                                        <div>Unit</div>
                                        <InputText v-model="props.form.address.unit" class="w-full" autocomplete="off" placeholder="Unit Number" required/>
                                    </div>

                                    <div class="col-span-2">
                                        <div>Street</div>
                                        <InputText v-model="props.form.address.street" class="w-full" autocomplete="off" placeholder="Street Name"/>
                                    </div>

                                    <div class="col-span-2">
                                        <div>Barangay</div>
                                        <InputText v-model="props.form.address.barangay" class="w-full" autocomplete="off" placeholder="Barangay"/>
                                    </div>
                                </div>

                                <div  class="grid grid-cols-2 gap-5 my-4">
                                    <div>
                                        <div>Municipality</div>
                                        <InputText v-model="props.form.address.municipality" class="w-full" autocomplete="off" placeholder="Municipality"/>
                                    </div>
                                    <div>
                                        <div>Province</div>
                                        <InputText v-model="props.form.address.province" class="w-full" autocomplete="off" placeholder="Province"/>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between pt-4">
                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="prevCallback" />
                                <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="validateForm('address', nextCallback)" />
                            </div>
                        </template>
                    </StepperPanel>

                    <StepperPanel>
                        <template #header="{ index, clickCallback }">
                            <button class="bg-transparent border-none inline-flex flex-column items-center justify-center gap-2 mb-2" @click="clickCallback">
                                <div class="flex items-center justify-center border border-1 rounded-full w-12 h-12 p-2">
                                    <i class="pi pi-truck" style="font-size: 1.8rem"/>
                                </div>
                                <span>Delivery Schedule</span>
                            </button>
                        </template>
                        <template #content="{ prevCallback }">
                            <DeliveryScheduleForm :form="form.delivery"/>
                            <div class="flex pt-4 justify-between">
                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="prevCallback" />
                                <div>
                                    <slot></slot>
                                </div>
                            </div>
                        </template>
                    </StepperPanel>
                </Stepper>
            </div>
        </template>
    </Card>
</template>

<script setup>
import { ref, onMounted, defineProps } from 'vue';
import DeliveryScheduleForm  from '@/Components/Forms/DeliveryScheduleForm.vue';

const checked = ref(false);

const props = defineProps({
    form: {
        type: Object,
        required: true 
    },
    action: {
        type: String,
        required: true
    },
});

const validateForm = (section ,nextCallback) => {

    if (section === 'customer') {
        if (!props.form.customer.name || !props.form.customer.cellphone_number) 
            return
    } else if (section === 'address') {
        if (!props.form.address.unit || !props.form.address.street || !props.form.address.barangay || !props.form.address.municipality || !props.form.address.province) 
            return
    } else {
        console.log('Validate delivery schedule')
    }

    nextCallback();
}

onMounted(() => {
    if (props.action === 'store') {
        checked.value = props.form.status;
    }

});
</script>

<style scoped>
.p-stepper {
    flex-basis: 50rem;
}
</style>
