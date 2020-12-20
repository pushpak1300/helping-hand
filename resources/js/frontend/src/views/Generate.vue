<template>
    <div>
        <base-header  type="gradient-default" class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
                     style="min-height: 100px; background-size: cover; background-position: center top;">
            <span class="mask bg-gradient-dark opacity-7"></span>
            <div class="container-fluid d-flex align-items-center">
            </div>
        </base-header>
        <div v-show="visible" class="container-fluid mt--7 col-xl-8 order-xl-1">
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
                                        v-model="form.name"
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
                                        v-model="form.age"
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

        <div class="container-fluid mt--7" v-if="profile">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img
                                            :src="profile.avtar"
                                            class="rounded-circle"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div
                            class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4"
                        ></div>
                        <div class="card-body pt-md-7">
                            <div class="text-center ">
                                <h2>
                                    {{ profile.name }}
                                    <span class="font-weight-light"
                                        >, {{ profile.age }}</span
                                    >
                                </h2>
                                <div class="h3 font-weight-300">
                                    {{ profile.city }}
                                </div>
                                <div class="h3 mt-3">
                                    Created by
                                </div>
                                <div v-if="profile.shopName">
                                    {{ profile.shopName }}
                                </div>
                                <div>
                                    {{ profile.city }}
                                </div>
                                <div class="h3 mt-3" v-if="profile.wallet">
                                    Balance: ₹ {{ profile.wallet }}
                                </div>
                                <vue-qrcode
                                    v-if="profile.id"
                                    :value="profile.id + ''"
                                /><br />
                                <div class="h2 mt-3">
                                    Pin: {{ profile.pin }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import User from "../api/User";
import VueQrcode from "vue-qrcode";

export default {
    name: 'Generate',
    data() {
        return {
            form: {
                name: '',
                age: ''
            },
            visible: true,
            profile: null
        }
    },
    components: {
        VueQrcode
    },
    methods: {
        showProfile() {
            User.generateQR(this.form).then(response => {
                if (response.data.success) {
                    this.profile = response.data.data;
                    this.visible = !this.visible;
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
};
</script>

<style></style>
