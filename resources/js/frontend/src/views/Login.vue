<template>
        <div class="row justify-content-center h-100" style="height:100%;">
            <div class="col-lg-5 col-md-7 mt-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>Sign in with credentials</small></div>
                        <FormulateForm
                            @submit="handleLogin"
                            v-model="details"
                            :errors="inputErrors"
                        >
                            <FormulateInput class="input-group-alternative mb-3"
                                        placeholder="Mobile No."
                                        addon-left-icon="ni ni-mobile-button"
                                        name="mobile"
                                        type="tel">
                            </FormulateInput>

                            <FormulateInput class="input-group-alternative"
                                        placeholder="Password"
                                        type="password"
                                        addon-left-icon="ni ni-lock-circle-open"
                                        name="password">
                            </FormulateInput>

                            <div class="text-center">
                                <FormulateInput type="submit" label="Log In" class="my-4 font-weight-bold" />
                            </div>
                        </FormulateForm>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="#" class="text-light"><small>Forgot password?</small></a>
                    </div>
                    <div class="col-6 text-right">
                        <router-link to="/register" class="text-light"><small>Create new account</small></router-link>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import User from "../api/User";

  export default {
    name: 'login',
    data() {
      return {
        details: {
          mobile: '',
          password: ''
        },
        inputErrors: {}
      }
    },
    methods: {
        handleLogin (data) {
            User.login(data).then(response => {
                this.$root.$emit("login", true);
                localStorage.setItem("token" , response.data.token);
                this.$router.push({ name: "dashboard" });
            })
            .catch((error => {
                this.inputErrors = error.response.data.message;
            }));
        }
    }
  }
</script>
<style>
</style>
