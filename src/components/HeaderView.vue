<template>
  <!-- Header Start -->
  <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <!-- Home Page -->
            <h1 class="text-white mt-4 mb-4" v-if="$route.path === '/'">Learn From Home</h1>
            <h1 class="text-white display-1 mb-5" v-if="$route.path === '/'">Education Courses</h1>

            <!-- About Page -->
            <h1 class="text-white display-1" v-if="$route.path === '/about'">About</h1>
            <div class="d-inline-flex text-white mb-5" v-if="$route.path === '/about'">
                <p class="m-0 text-uppercase"><router-link to="/" class="text-white">Home</router-link></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">About</p>
            </div>

            <!-- Contact Page -->
            <h1 class="text-white display-1" v-if="$route.path === '/contact'">Contact</h1>
            <div class="d-inline-flex text-white mb-5" v-if="$route.path === '/contact'">
                <p class="m-0 text-uppercase"><router-link to="/" class="text-white">Home</router-link></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Contact</p>
            </div>

            <!-- Contact Page -->
            <h1 class="text-white display-1" v-if="$route.path === '/detail'">Course Detail</h1>
            <div class="d-inline-flex text-white mb-5" v-if="$route.path === '/detail'">
                <p class="m-0 text-uppercase"><router-link to="/" class="text-white">Home</router-link></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Course Detail</p>
            </div>

            <!-- courses Page -->
            <!-- <h1 class="text-white display-1" v-if="$route.path === '/courses'">Courses</h1>
            <div class="d-inline-flex text-white mb-5" v-if="$route.path === '/courses'">
                <p class="m-0 text-uppercase"><router-link to="/" class="text-white">Home</router-link></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Courses</p>
            </div>

            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;" v-if="$route.path === '/courses'">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            {{ currentCategory ? currentCategory.name : 'All'  }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" @click.prevent="setCurrentCategory(null)" >All</a>
                            <a class="dropdown-item"  v-for="(category, index) in categories" :key="index"  @click.prevent="setCurrentCategory(category)" >{{ category.name }}</a>
                        </div>
                    </div>
                    <input type="text" class="form-control border-light" v-model="keyword" style="padding: 30px 25px;" placeholder="Keyword">
                    <div class="input-group-append">
                        <button class="btn btn-secondary px-4 px-lg-5" @click="searchCourses">Search</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- Header End -->
</template>

<script>

</script>

<style>

</style>