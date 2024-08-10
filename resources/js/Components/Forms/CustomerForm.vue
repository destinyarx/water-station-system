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
                                <InputText v-model="props.form.details.name" class="w-full" placeholder="Enter Customer Name" :invalid="!props.form.details.name && isSubmitted" autocomplete="off"/>

                                <div class="mb-2 mt-4">
                                    Cellphone Number
                                    <span class="text-rose-800">*</span>
                                </div>
                                <InputNumber v-model="props.form.details.cellphone_number" class="w-full" placeholder="Mobile Number" :invalid="!props.form.details.cellphone_number && isSubmitted" autocomplete="off" />

                                <div class="mb-2 mt-4">Email <small>(Optional)</small></div>
                                <InputText v-model="props.form.details.email" class="w-full" placeholder="Enter Email Address" autocomplete="off"/>

                                <div class="mb-2 mt-4">Facebook <small>Optional</small></div>
                                <InputText v-model="props.form.details.messenger_name" class="w-full" placeholder="Facebook Messenger Username" autocomplete="off"/>

                                <!-- <div class="mb-2 mt-4">Status</div>
                                <ToggleButton v-model="props.form.details.status" onLabel="Active" offLabel="Inactive" /> -->

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
                                        <InputText v-model="props.form.address.unit" class="w-full" autocomplete="off" placeholder="Unit Number" :invalid="!props.form.address.unit && isSubmitted"/>
                                    </div>

                                    <div class="col-span-2">
                                        <div>Street</div>
                                        <InputText v-model="props.form.address.street" class="w-full" autocomplete="off" placeholder="Street Name" :invalid="!props.form.address.street && isSubmitted"/>
                                    </div>

                                    <div class="col-span-2">
                                        <div>Barangay</div>
                                        <InputText v-model="props.form.address.barangay" class="w-full" autocomplete="off" placeholder="Barangay" :invalid="!props.form.address.barangay && isSubmitted"/>
                                    </div>
                                </div>

                                <div  class="grid grid-cols-2 gap-5 my-4">
                                    <div>
                                        <div>Municipality</div>
                                        <InputText v-model="props.form.address.municipality" class="w-full" autocomplete="off" placeholder="Municipality" :invalid="!props.form.address.municipality && isSubmitted"/>
                                    </div>
                                    <div>
                                        <div>Province</div>
                                        <InputText v-model="props.form.address.province" class="w-full" autocomplete="off" placeholder="Province" :invalid="!props.form.address.province && isSubmitted"/>
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

const isSubmitted = ref(false);
const validateForm = (section ,nextCallback) => {
    isSubmitted.value = true;

    if (section === 'customer') {
        if (!props.form.details.name || !props.form.details.cellphone_number) 
            return
    } 
    
    // else if (section === 'address') {
    //     if (!props.form.address.unit || !props.form.address.street || !props.form.address.barangay || !props.form.address.municipality || !props.form.address.province) 
    //         return
    // } else {
    //     console.log('Validate delivery schedule')
    // }

    isSubmitted.value = false;
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
