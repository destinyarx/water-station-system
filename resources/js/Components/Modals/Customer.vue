<template>
    <Card>
        <template #content>

            

            <!-- start -->
             

    <div class="card flex justify-content-center">
        <Stepper linear>
            <StepperPanel>
                <template #header="{ index, clickCallback }">
                    <button class="bg-transparent border-none inline-flex flex-column items-center justify-center gap-2 mb-2" @click="clickCallback">
                        <div class="flex items-center justify-center border border-1 rounded-full w-12 h-12 p-2">
                            <i class="pi pi-user" style="font-size: 1.8rem"/>
                        </div>
                        <span class="font-bold">Details</span>
                    </button>
                </template>
                <template #content="{ nextCallback }">
                    <!-- Customer Details Form -->
                    <div class="w-100">
                        <div class="mb-2"> Name 
                            <span class="text-rose-800">*</span>
                        </div>
                        <InputText v-model="props.form.name" class="w-full" autocomplete="off"/>

                        <div class="mb-2 mt-4">
                            Cellphone Number
                            <span class="text-rose-800">*</span>
                        </div>
                        <InputNumber v-model="props.form.cellphone_number" class="w-full" autocomplete="off"/>

                        <div class="mb-2 mt-4">Email <small>(Optional)</small></div>
                        <InputText v-model="props.form.email" class="w-full" autocomplete="off"/>

                        <div class="mb-2 mt-4">Facebook <small>Optional</small></div>
                        <InputText v-model="props.form.messenger_name" class="w-full" autocomplete="off"/>

                        <!-- <div class="mb-2 mt-4">Status</div>
                        <ToggleButton v-model="checked" onLabel="Active" offLabel="Inactive" /> -->

                        <div class="flex justify-end mt-5">
                            <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
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
                        <span class="font-bold">Address</span>
                    </button>
                </template>
                <template #content="{ prevCallback, nextCallback }">
                    <div class="flex flex-column h-12rem">
                        <div class="border-2 border-dashed surface-border border-round surface-ground flex-auto flex justify-content-center align-items-center font-medium">Content II</div>
                    </div>
                    <div class="flex justify-between pt-4">
                        <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="prevCallback" />
                        <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
                    </div>
                </template>
            </StepperPanel>

            <StepperPanel>
                <template #header="{ index, clickCallback }">
                    <button class="bg-transparent border-none inline-flex flex-column items-center justify-center gap-2 mb-2" @click="clickCallback">
                        <div class="flex items-center justify-center border border-1 rounded-full w-12 h-12 p-2">
                            <i class="pi pi-truck" style="font-size: 1.8rem"/>
                        </div>
                        <span class="font-bold">Delivery Schedule</span>
                    </button>
                </template>
                <template #content="{ prevCallback }">
                    <div class="flex flex-column h-12rem">
                        <div class="border-2 border-dashed surface-border border-round surface-ground flex-auto flex justify-content-center align-items-center font-medium">Content III</div>
                    </div>
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




            <!-- end -->
        </template>
        <!-- <template #footer>
            <slot></slot>
        </template> -->
    </Card>

    
</template>

<script setup>
import { ref, onMounted, defineProps } from 'vue';



import Stepper from 'primevue/stepper';
import StepperPanel from 'primevue/stepperpanel';



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
