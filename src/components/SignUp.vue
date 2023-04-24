<template>
  <div id="SignUp" class="container-fluid px-0 py-5">
    <div class="row mx-0 justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Start Your Journey!</h6>
                </div>
            </div>   
    </div>
        <div class="row justify-content-center bg-image mx-0 mb-5">
            <div class="col-lg-6 py-5">
                <div class="bg-white p-5 my-5">
                    <h1 class="text-center mb-4" v-if="loginStatus">Login Here!</h1>
                    <h1 class="text-center mb-4" v-else>Register Here!</h1>
                    <form v-if="loginStatus">
                        <div class="alert alert-danger" role="alert" v-if="loginError">
                             The Credential Do Not Match !
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" class="form-control bg-light border-0" placeholder="Your Email" style="padding: 30px 20px;" v-model="loginData.email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="password" class="form-control bg-light border-0" placeholder="Your Password" style="padding: 30px 20px;" v-model="loginData.password" @keyup.enter="login">
                                </div>
                            </div>
                            
                            <div class="col-sm-6 offset-3">
                                <button class="btn btn-primary btn-block" type="submit" style="height: 60px;" @click="login">Login Now</button>
                            </div>
                        </div>
                    </form>
                    <form v-else>
                        <div class="alert alert-danger" role="alert" v-if="registerError">
                             The Credential Do Not Match !
                        </div>
                        <div class="alert alert-danger" role="alert" v-if="validationErrors">
                             {{ validationErrors }}
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Your Name" style="padding: 30px 20px;" v-model="registerData.name">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" class="form-control bg-light border-0" placeholder="Your Email" style="padding: 30px 20px;" v-model="registerData.email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="password" class="form-control bg-light border-0" placeholder="Your Password" style="padding: 30px 20px;" v-model="registerData.password" @keyup.enter="register">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-block" type="submit" style="height: 60px;" @click="register">Sign Up Now</button>
                            </div>
                        </div>
                    </form>
                    <h6 class="text-center my-3" v-if="loginStatus">You don't have an account? <router-link to="/signUp" @click="loginStatus = !loginStatus">Register Here!</router-link> </h6>
                    <h6 class="text-center my-3" v-else>You already have an account? <router-link to="/signUp" @click="loginPage">Login Here!</router-link> </h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../composables/auth"></script>

