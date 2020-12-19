<template>
    <div>
        <base-header  type="gradient-default" class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
                     style="min-height: 100px; background-size: cover; background-position: center top;">
            <span class="mask bg-gradient-dark opacity-7"></span>
            <div class="container-fluid d-flex align-items-center">
            </div>
        </base-header>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">

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
                           
                        </div>
                        <div class="card-body pt-md-7">
                            <div class="text-center ">
                                <h3>
                                    Jessica Jones<span class="font-weight-light">, 27</span>
                                </h3>
                                <div class="h5 font-weight-300">
                                    <i class="ni location_pin mr-2"></i>Bucharest, Romania
                                </div>
                                <div class="h5 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>Created by
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Gmart
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>at Mumbai
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
                                            <a href="#!" class="btn btn-md btn-primary px-5">Pay</a>
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
  export default {
    name: 'user-profile',
    data() {
      return {
        model: {
          amount: ''
        }
      }
    },
  };
</script>
<style></style>
