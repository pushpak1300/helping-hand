<template>
    <div>
        <base-header class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
                     style="min-height: 100px; background-size: cover; background-position: center top;">
            <span class="mask bg-gradient-dark opacity-10"></span>
            <div class="container-fluid d-flex align-items-center">
                <!-- <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Hello Jesse</h1>
                        <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                        <a href="#!" class="btn btn-info">Edit profile</a>
                    </div>
                </div> -->
            </div>
        </base-header>

        <div class="container-fluid mt--8">
            <div class="row">

                <div class="col-xl-8  mb-5 order-xl-1">
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
                                        <div class="col-lg-6">
                                            <base-input alternative=""
                                                        label="Name"
                                                        placeholder="Name"
                                                        input-classes="form-control-alternative"
                                                        v-model="model.name"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <base-input alternative=""
                                                        label="Age"
                                                        placeholder="Age"
                                                        input-classes="form-control-alternative"
                                                        v-model="model.age"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-sm btn-primary">Generate</button>
                                </div>
                            </form>
                        </template>
                    </card>
                </div>
            </div>
        </div>

        <div class="col-xl-4 order-xl-2 mt-5 mb-xl-0">

                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img src="img/theme/team-4-800x800.jpg" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                            </div>
                            <div class="text-center mt-md-5">
                                <h3>
                                    Jessica Jones<span class="font-weight-light">, 27</span>
                                </h3>
                                <div class="h5 font-weight-300">
                                    <i class="ni location_pin mr-2"></i>Bucharest, Romania
                                </div>
                                <div class="h5 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>University of Computer Science
                                </div>
                            </div>
                            <vue-qrcode value="https://www.npmjs.com/package/vue-qrcode#usage" />
                        </div>
                    </div>
                </div>
    </div>
</template>
<script>
import VueQrcode from 'vue-qrcode'

  export default {
    name: 'user-profile',
    data() {
      return {
        model: {
          name: '',
          age: ''
        }
      }
    },
    components: {
        VueQrcode,
    }
  };
</script>
<style></style>
