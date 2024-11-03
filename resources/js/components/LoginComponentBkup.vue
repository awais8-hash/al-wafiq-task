<template>
    <div class="d-flex justify-content-center align-items-center sign-in-page">
        <div class="container p-xl-5 p-lg-5 p-md-4 p-sm-3 p-3 sign-in-wrapper">
            <div class="row no-gutters">
                <div
                    class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 border-right pr-xl-5 pr-lg-5 pr-md-5 pr-sm-5 pr-0 pb-xl-0 pb-lg-0 pb-md-0 pb-sm-0 pb-4 guest-form-login">
                    <h4 class="text-muted mb-3">Guest User</h4>
                    <p class="text-muted mb-5">Not Your Device? Use Guest mode to sign in</p>
                    <a href="javascript:void(0)">Continue as Guest User &rarr;</a>
                </div>
                <div
                    class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12  pl-0 pl-xl-5 pl-lg-5 pl-md-4 pl-sm-3 pt-4 pt-xl-0 pt-lg-0 pt-md-0 pt-sm-0">
                    <h4 class="text-muted text-center mb-0"> Registered User</h4>
                    <div class="text-center mb-4">
                        <small>Sign in to start your session</small>
                    </div>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="" v-model="login_data.email" required
                                autocomplete="off">
                            <label class="floating-label" for="inputField">Email</label>
                        </div>
                        <div class="form-group mt-4 position-relative">
                            <input :type="showPassword ? 'text' : 'password'" class="form-control" placeholder=" "
                                v-model="login_data.password" @keyup.enter="login" @input="updatePassword" required
                                autocomplete="off">
                            <label class="floating-label" for="inputField">Password
                            </label>
                            <div class="d-flex position-absolute" style=" top: 18px; right: 12px;">
                                <a class="border-0 bg-transparent text-muted" href="javascript:void(0)"
                                    id="showPasswordCheckbox" @click="togglePasswordVisibility">
                                    <i :class="{ 'far fa-eye': !showPassword, 'fas fa-eye-slash': showPassword }"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="pt-5 px-1 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center justify-content-between">
                            <img src="google.svg" alt="google">
                            <a href="/googleLogin"> Sign up with Google</a>
                        </div>
                        <button type="button" :disabled="loading" @click="login"
                            class="btn btn-primary btn-sm action-buttons px-4">
                            <span v-if="!loading">Sign In</span>
                            <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            login_data: {
                email: '',
                password: ''
            },
            login_error: '',
            modalType: '',
            is_register_customer: false,
            loading: false,
            showPassword: false,
            previousRoute: '',
        }
    },
    methods: {
        login() {

        },
        updatePassword() {
            this.login_error = '';
        },
        togglePasswordVisibility() {
            this.showPassword = !this.showPassword; // Toggle the showPassword property
        },
    },
    created() {
    },
};
</script>

<style scoped>
/*sign in page css starts here  */
.sign-in-page {
    background-color: #e8f3ff;
    height: 100vh;
}

.sign-in-wrapper {
    border-radius: 15px;
    backdrop-filter: blur(18px);
    background-color: white;
}

a {
    text-decoration: none;
}

.action-buttons:hover {
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
}

.form-group {
    position: relative;
    margin-bottom: 0px;
}

.form-control {
    padding-top: 0.5rem;
    padding-bottom: 0.75rem;
    height: calc(3.25rem + 2px);


}

.form-control:focus {
    box-shadow: none;
    border: 2px solid;
    border-color: #3f51b5;
}

.form-control:focus~.floating-label,
.form-control:not(:placeholder-shown)~.floating-label {
    top: -11px;
    left: 10px;
    font-size: 0.9rem;
    background-color: white;
}

.floating-label {
    position: absolute;
    pointer-events: none;
    left: 1rem;
    top: 1rem;
    transition: 0.4s ease all;
    color: #3e3e3e;
    padding: 0 5px;
}

@media (max-width:577.5px) {
    .guest-form-login {
        border-right: none !important;
        border-bottom: 1px solid #d8d8d8;
    }

    .sign-in-page {
        padding: 0 .5rem;
    }
}

/*sigin page css ends here  */
</style>
