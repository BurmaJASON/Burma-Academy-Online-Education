<template>
  <!-- Detail Start -->
  <div class="container-fluid py-5">
      <div class="container py-5">
          <a  class="btn btn-primary mb-4" @click="back">Back To Courses</a>
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <div class="section-title position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Course Detail</h6>
                            <h1 class="display-6">{{ course.title }}</h1>
                        </div>
                        <img class="img-fluid rounded w-100 mb-4" :src="course.image" alt="Image">
                        <h6>{{ course.intro }}</h6>
                        <hr>
                        <p v-html="course.body"></p>
                    </div>

                    <!-- Comment Form -->
                    <section class="container">                            
                        <h4 class="text-center" v-if="!tokenStatus">Please <router-link to="/signUp">Login</router-link> to participate in this section!</h4>
                        
                            <div class="card d-flex p-3 my-3 shadow rounded-lg" v-else>                     
                                <div class="mb-3">
                                    <textarea required class="form-control border border-0" @keyup.enter="comment" cols="10" rows="3" placeholder="Say something..." name="body" v-model="body"></textarea>
                                        <!-- <x-error name="body"/> -->
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit" @click="comment">Comment</button>
                                </div>
                            </div>
                        </section>
                        
                    <!-- Comments -->
                    <section class="container my-5">
                            <h4 class="my-3 text-muted">Comments ({{ commentLength }})</h4>
                            <div v-if="commentLength === 0">
                                <h5 class="my-3 text-muted text-center">There are no comments yet.</h5>
                            </div>
                            <div v-else  class="d-flex p-2 mt-3 shadow-sm rounded-sm bg-light" v-for="(comment , index) in course.comments" :key="index" >
                                <div class="d-flex">
                                        <div>
                                            <img v-if="comment.author.image == null" src="http://localhost:8000/assets/imgs/abstract-user-flat-4.png" width="50" height="50" class="rounded-circle" alt="">
                                            <img v-else :src="'http://localhost:8000/storage/profileImage/' + comment.author.image" width="50" height="50" class="rounded-circle" alt="">
                                        </div>
                                        <div class="ml-3">
                                            <h6>{{ comment.author.user_name }} 
                                                <small class="ml-2 text-muted">{{ formatDateTime(comment.created_at) }}</small>
                                            </h6>
                                            <span class="text-muted">
                                                {{ comment.body }}
                                            </span>
                                        </div>
                                    </div>
                                    
                            </div>
                    </section>

               </div>

                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="bg-primary mb-5 py-3">
                        <h3 class="text-white py-3 px-4 m-0">Course Features</h3>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Instructor</h6>
                            <h6 class="text-white my-3">{{ instructor }}</h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Rating</h6>
                            <h6 class="text-white my-3">4.5 <small>({{ course.view_count }})</small></h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">Skill level</h6>
                            <h6 class="text-white my-3">All Level</h6>
                        </div>
                        <div class="d-flex justify-content-between px-4">
                            <h6 class="text-white my-3">Language</h6>
                            <h6 class="text-white my-3">English</h6>
                        </div>
                        <h5 class="text-white py-3 px-4 m-0">Course Price: ${{ course.price }}</h5>
                        <div class="py-3 px-4">
                            <router-link to="/signUp" class="btn btn-block btn-secondary py-3 px-5"   v-if="!tokenStatus">
                                <del >Enroll</del>Login Here!
                            </router-link>

                            <a class="btn btn-block btn-secondary py-3 px-5" 
                                @click="enroll(course.id)" 
                                v-else-if="enrollStatement === null || enrollStatement === undefined">Enroll Now</a>

                            <div v-else-if="enrollStatement == false">
                                <a class="btn btn-block btn-secondary py-3 px-5"  disabled @click="cancelEnroll(course.id)" >Cancle Enroll</a>
                                <small class="text-white text-center">Your request is in the progress please wait!</small>
                            </div>
                            <a class="btn btn-block btn-light py-3 px-5 enrolled"  disabled v-else>Enrolled</a>

                            <!-- <a class="btn btn-block btn-secondary py-3 px-5" @click="enrollStatement =!enrollStatement" v-if="enrollStatement">Cancel Enroll</a> -->

                        </div>
                    </div>

                    <!-- All Subjects -->
                    <div class="mb-5">
                        <h2 class="mb-3">Subjects</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0" v-for="(category , index) in categories" :key="index">
                                <span href="" class="text-decoration-none h6 m-0">{{ category.data.name }}</span>
                                <span class="badge badge-primary badge-pill">{{ category.count }}</span>
                            </li>
                            
                        </ul>
                    </div>

                    <!-- Recent Courses -->
                    <div class="mb-5">
                        <h2 class="mb-4">Recent Courses</h2>
                        <div  v-for="(Lcourse , index) in latestCourses" :key="index">
                            <a @click="nextCourse(Lcourse.slug)" class="d-flex align-items-center text-decoration-none mb-4 row" >
                                <img  class="img-fluid rounded col-3" :src="Lcourse.image" alt="">
                                <div class=" col-9" >
                                    <h6>{{ Lcourse.title }}</h6>
                                    <div class="d-flex">
                                        <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>{{ Lcourse.instructor.user_name }}</small>
                                        <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5 ({{ Lcourse.view_count }})</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->
</template>

<script src="../composables/detail"></script>


<style>
    .enrolled:hover {
        background-color: #ecf4ff;
    }
</style>