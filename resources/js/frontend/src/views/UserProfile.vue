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
                                <h2 class="mb-0">
                                    {{ profile.name }}
                                    <span class="font-weight-light">, {{ profile.age }}</span>
                                </h2>
                                <div class="h3 font-weight-300 mt-0" >
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
                                <div class="h3 mt-3" v-if="!isUser">
                                    Balance: ₹ {{ profile.wallet }}
                                </div>
                                <button
                                    v-if="isUser"
                                    class="btn btn-lg btn-primary text-lg mt-3"
                                    @click="$router.push({ name: 'payment', params: { id: profile.id } })"
                                >
                                    Donate
                                </button>
                                <button
                                    v-else
                                    class="btn btn-lg btn-primary text-lg mt-3"
                                    @click="$router.push({ name: 'payment', params: { id: profile.id } })"
                                >
                                    Redeem
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
import Reciever from "../api/Reciever";
export default {
    name: "user-profile",
    data() {
        return {
            profile: null
        };
    },
    computed: {
        isUser() {
            return localStorage.getItem("role") === "user";
        },
        isMerchant() {
            return localStorage.getItem("role") === "merchant";
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
