<template>
  <div>
        <!-- Topbar Start -->
    <div class="container-fluid bg-dark ">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+970 30 58XX</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>burmaacademy@edu.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <router-link to="/" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Burma Academy</h1>
            </router-link>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <router-link to="/"  class="nav-item nav-link" :class="{ active: $route.path === '/' }">Home</router-link>
                    <router-link to="/about"  class="nav-item nav-link" :class="{ active: $route.path === '/about' }" >About</router-link>
                    <router-link to="/courses"  class="nav-item nav-link" :class="{ active: $route.path === '/courses' }">Courses</router-link>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="team.html" class="dropdown-item">Instructors</a>
                            <a href="testimonial.html" class="dropdown-item">Reviews</a>
                        </div>
                    </div> -->
                    <router-link to="/contact"  class="nav-item nav-link" :class="{ active: $route.path === '/contact' }">Contact</router-link>

                    <router-link :to="tokenStatus ? '/library' : '/signUp' "  class="nav-item nav-link" :class="{ active: $route.path === '/library', 'text-muted': !tokenStatus }" :disabled="!tokenStatus" @click.prevent="tokenStatus || $router.replace('/signUp')">Your Library</router-link>
                    
                </div>
                <router-link to="/signUp" class="btn btn-primary py-2 px-4 d-none d-lg-block" v-if="tokenStatus == false">Join Us</router-link>
                <a class="btn btn-dark py-2 px-4 d-none d-lg-block" v-else @click="logout">LogOut</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    
  </div>
</template>

<!-- <script>
import { mapGetters } from 'vuex';

export default {
    data() {
    return  {
      tokenStatus : false
    }
  },

  computed : {
    ...mapGetters(["token"])
  },

  methods: {
    checkToken() {
      if(this.token != null && this.token != undefined && this.token != '') {
        this.tokenStatus = true;
      }else {
        this.tokenStatus = false;
      }
    },
    
    logout() {
        this.$store.dispatch('setToken',null);
        this.$router.push({
            name : 'signUp'
        })
    }
  },

  mounted() {
    this.checkToken();
  }

}
</script> -->

<script src="../composables/tokenStatus"></script>