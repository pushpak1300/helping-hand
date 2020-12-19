<template>
    <div>
        <base-header
            type="gradient-default"
            class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
            style="min-height: 100px; background-size: cover; background-position: center top;"
        >
            <span class="mask bg-gradient-dark opacity-7"></span>
            <div class="container-fluid d-flex align-items-center"></div>
        </base-header>

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
                                    <i class="ni location_pin mr-2"></i
                                    >{{ profile.city }}
                                </div>
                                <div class="h2 mt-3">
                                    <i class="ni business_briefcase-24 mr-2"></i
                                    >Created by
                                </div>
                                <div v-if="profile.shopName">
                                    <i class="ni education_hat mr-2"></i
                                    >{{ profile.shopName }}
                                </div>
                                <div>
                                    <i
                                        class="ni education_hat font-bold mr-2"
                                    ></i>
                                    {{ profile.city }}
                                </div>
                                <div v-if="profile.balance">
                                    <i class="ni education_hat mr-2"></i
                                    >{{ profile.balance }}
                                </div>
                                <vue-qrcode
                                    v-if="profile.id"
                                    :value="profile.id + ''"
                                /><br />
                                <button
                                    v-if="isUser"
                                    class="btn btn-lg btn-primary text-lg"
                                    @click="$router.push({ name: 'payment', params: { id: profile.id } })"
                                >
                                    Donate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueQrcode from "vue-qrcode";
import Reciever from "../api/Reciever";
export default {
    name: "user-profile",
    data() {
        return {
            profile: null
        };
    },
    components: {
        VueQrcode
    },
    computed: {
        isUser() {
            return localStorage.getItem("role") === "user";
        }
    },
    mounted() {
        Reciever.profile(this.$route.params.id).then(response => {
            this.profile = response.data.data;
        });
    }
};
</script>
<style></style>
