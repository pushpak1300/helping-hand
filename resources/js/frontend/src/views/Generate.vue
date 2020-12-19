<template>
    <div v-show="visible" class="col-xl-8 order-xl-1">
        <card shadow type="secondary">
            <div slot="header" class="bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Generate QR Code</h3>
                    </div>
                </div>
            </div>
            <template>
                <form @submit.prevent>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <base-input
                                    alternative=""
                                    label="Name"
                                    placeholder="Name"
                                    input-classes="form-control-alternative"
                                    v-model="model.name"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <base-input
                                    alternative=""
                                    label="Age"
                                    placeholder="Age"
                                    input-classes="form-control-alternative"
                                    v-model="model.age"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button
                            @click="showProfile"
                            class="btn btn-sm btn-primary"
                        >
                            Generate
                        </button>
                    </div>
                </form>
            </template>
        </card>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
