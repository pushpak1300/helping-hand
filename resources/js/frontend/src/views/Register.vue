<template>

    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <!-- <div class="card-header bg-transparent pb-5">
                    <div class="text-muted text-center mt-2 mb-3">
                        <small>Sign up with</small>
                    </div>
                    <div class="btn-wrapper text-center">
                        <a href="#" class="btn btn-neutral btn-icon">
                            <span class="btn-inner--icon"><img src="img/icons/common/github.svg"></span>
                            <span class="btn-inner--text">Github</span>
                        </a>
                        <a href="#" class="btn btn-neutral btn-icon">
                            <span class="btn-inner--icon"><img src="img/icons/common/google.svg"></span>
                            <span class="btn-inner--text">Google</span>
                        </a>
                    </div>
                </div> -->
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <small>Sign up to Helping Hand</small>
                    </div>
                    <FormulateForm
                        @submit="handleSignUp"
                        v-model="details" 
                    >

                        <FormulateInput class="input-group-alternative mb-3"
                                    placeholder="Name"
                                    addon-left-icon="ni ni-circle-08"
                                    name="name"
                                    validation="required">
                                    <element><div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                    </div></element>
                        </FormulateInput>

                        <FormulateInput class="input-group-alternative mb-3"
                                    placeholder="Mobile No."
                                    addon-left-icon="ni ni-mobile-button"
                                    name="mobile"
                                    validation="required"
                                    type="tel">
                        </FormulateInput>

                        <FormulateInput class="input-group-alternative"
                                    placeholder="Password"
                                    type="password"
                                    addon-left-icon="ni ni-lock-circle-open"
                                    name="password"
                                    validation="required">
                        </FormulateInput>

                        <!-- <div class="row my-4">
                            <div class="col-12">
                                <base-checkbox class="custom-control-alternative">
                                    <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                                </base-checkbox>
                            </div>
                        </div> -->
                        <div class="text-center">
                            <FormulateInput type="submit" label="Sign Up" class="my-4"/>
                        </div>
                    </FormulateForm>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <router-link to="/login" class="text-light">
                        <small>Login into your account</small>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import User from "../api/User"

  export default {
    name: 'register',
    data() {
      return {
        details: {
          name: '',
          mobile: '',
          password: ''
        }
      }
    },
    methods: {
        handleSignUp (data) {
            User.register(data).then(response => {
                this.$root.$emit("login", true);
                localStorage.setItem("token" , response.data.token);
                this.$router.push({ name: "dashboard" });
            })
            .catch((error => {
                if (error.response.status === 422) {
                    this.inputErrors = error.response.data.errors;
                }
            }));
        }
    }
  }
</script>
<style>
</style>
