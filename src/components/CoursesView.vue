<template>
    <div>
       <!-- Courses Start -->
       <!-- courses Page -->
       <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
            <div class="container text-center my-5 py-5">
                <h1 class="text-white display-1" >Courses</h1>
                <div class="d-inline-flex text-white mb-5" >
                    <p class="m-0 text-uppercase"><router-link to="/" class="text-white">Home</router-link></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Courses</p>
                </div>

                <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;" >
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                <!-- {{ currentCategory || 'Subject'  }} -->
                                {{ currentCategory ? currentCategory : 'All' }}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" :class="{ active: !currentCategory }" @click.prevent="setCurrentCategory(null); searchCourses();">All</a>
                                <a class="dropdown-item" :class="{ active: category.name === currentCategory }"  v-for="(category, index) in categories" :key="index"  @click.prevent="setCurrentCategory(category); searchCourses();">{{ category.name }} </a>
                            </div>
                        </div>
                        <input type="text" class="form-control border-light" v-model="keyword" style="padding: 30px 25px;" placeholder="Keyword" @keyup.enter="searchCourses">
                        <div class="input-group-append">
                            <button class="btn btn-secondary px-4 px-lg-5" @click="searchCourses">Search</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
       <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row mx-0 justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Our Courses</h6>
                            <h1 class="display-4">Checkout New Releases Of Our Courses</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mx-auto my-5" v-if="displayedCourses.length == 0 && coursesList.length == 0">
                        <h1 class="text-muted">There is no such course!</h1>
                    </div>
                </div>
                
                <div class="row" v-if="currentCategory === null && keyword == ''"  >
                    <div class="col-lg-4 col-md-6 pb-4"  v-for="(course, index) in coursesList" :key="index">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" @click="courseDetail(course.slug)">
                            <img class="img-fluid" :src="course.image" alt="">
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3">{{ course.title }}</h4>
                                <div class="border-top w-100 mt-3">
                                    <div class="d-flex justify-content-between p-4">
                                        <span class="text-white"><i class="fa fa-user mr-2"></i>{{ course.instructor.user_name }}</span>
                                        <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                            <small>( {{ course.view_count }} )</small></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row" v-else >
                    <div class="col-lg-4 col-md-6 pb-4"  v-for="(course, index) in displayedCourses" :key="index">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" @click="courseDetail(course.slug)">
                            <img class="img-fluid" :src="course.image" alt="">
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3">{{ course.title }}</h4>
                                <div class="border-top w-100 mt-3">
                                    <div class="d-flex justify-content-between p-4">
                                        <span class="text-white"><i class="fa fa-user mr-2"></i>{{ course.instructor.user_name }}</span>
                                        <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                            <small>( {{ course.view_count }} )</small></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center mt-3" v-if="paginate">
                    <v-pagination
                        v-model="page"
                        :pages="pageCount"
                        :range-size="1"
                        active-color="rgb(191, 217, 255)"
                        @update:modelValue="getAllCourses"
                    />
                </div>
            </div>
        </div>
        <!-- Courses End -->
    </div>
</template>

<script src="../composables/courses"></script>

