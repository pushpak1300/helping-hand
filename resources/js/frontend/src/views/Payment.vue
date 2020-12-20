<template>
    <div>
        <modal :show.sync="modals.isVisible">
            <template slot="header">
                <h5 class="modal-title" id="exampleModalLabel">One click away!</h5>
            </template>
            <div v-if="isUser">
                Are you sure you want to donate ₹ {{ model.amount }}?
            </div>
            <div v-else>
                Are you sure you want to redeem ₹ {{ model.amount }}?
            </div>
            <template slot="footer">
                <base-button type="secondary" @click="modals.modal0 = false"
                    >Close</base-button
                >
                <base-button type="primary" @click="transferMoney">Yes</base-button>
            </template>
        </modal>
        <base-header  type="gradient-default" class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
                     style="min-height: 100px; background-size: cover; background-position: center top;">
            <span class="mask bg-gradient-dark opacity-7"></span>
            <div class="container-fluid d-flex align-items-center">
            </div>
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
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-xl-8 order-xl-1">
                    <card shadow type="secondary">
                        <div slot="header" class="bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Proceed Payment</h3>
                                </div>
                            </div>
                        </div>
                        <template>
                            <form @submit.prevent>
                               
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <base-input alternative=""
                                                        label="Amount"
                                                        placeholder="Amount"
                                                        input-classes="form-control-alternative"
                                                        v-model="model.amount"
                                            />
                                        </div>
                                        <div class=" col-lg-6 text-center">
                                            <button
                                                v-if="isUser"
                                                class="btn btn-lg btn-primary text-lg"
                                                @click="modals.isVisible = true"
                                            >
                                                Donate
                                            </button>
                                            <button
                                                v-else
                                                class="btn btn-lg btn-primary text-lg"
                                                @click="modals.isVisible = true"
                                            >
                                                Redeem
                                            </button>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                               
                            </form>
                        </template>
                    </card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Reciever from "../api/Reciever";
import User from "../api/User";
// js import
import swal from 'sweetalert2';

// style import
import 'sweetalert2/dist/sweetalert2.css';

  export default {
    name: 'payment',
    data() {
      return {
        model: {
          amount: ''
        },
        profile: null,
        modals: {
            isVisible: false
        }
      }
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
    },
    methods: {
        showSwal(type) {
            if (this.isUser) {
                swal.fire({
                    title: `Success`,
                    text: 'Donated Successfully!',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-success',
                    icon: 'success',
                    onClose: this.$router.push({ name: 'donate' })
                });
            } else {
                if (type == "success") {
                    swal.fire({
                        title: `Success`,
                        text: 'Redeemed Successfully!',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-success',
                        icon: 'success',
                        onClose: this.$router.push({ name: 'donate' })
                    });
                }
                else {
                    swal.fire({
                        title: `Warning`,
                        text: 'Insufficient Balance!',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-warning',
                        icon: 'warning',
                    });
                }
            }
        },

        transferMoney() {
            User.transferMoney(this.profile.id, this.model).then(response => {
                if (response.data.success) {
                    this.showSwal('success');
                    this.modals.isVisible = false;
                }
                else {
                    this.showSwal('error');
                    this.modals.isVisible = false;
                }
            })
            .catch(error => {
                console.log(error.message);
            });
        }
    }
  };
</script>
<style></style>
