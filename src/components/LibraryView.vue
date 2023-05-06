<template>
  <div class="card ">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" :class="{ active: selectedTab === 'all' }" @click="selectedTab = 'all'">
                    All
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{ active: selectedTab === 'pending' }" @click="selectedTab = 'pending'">
                    Pending
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{ active: selectedTab === 'accepted' }" @click="selectedTab = 'accepted'">
                    Accepted
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{ active: selectedTab === 'rejected' }" @click="selectedTab = 'rejected'">
                    Rejected
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="mx-auto my-5" v-if="enrollments.length == 0">
            <h1 class="text-muted">There is no course you enrolled!</h1>
        </div>
    </div>


        <div class="card-body" v-for="(enrollment, index) in filteredEnrollments" :key="index" @click="courseDetail(enrollment.course.slug)">
            <div class="rounded shadow">
                <div class="card-body row">
                <div class="col-md-2">
                    <img :src="enrollment.course.image" class="w-100 rounded shadow-sm" alt="">
                </div>
                <div class="col-md-8 py-2">
                    <h4 class="mb-0">{{ enrollment.course.title }}</h4>
                    <p class="text-muted">{{ enrollment.course.intro }}</p>
                </div>
                <div class="col-md-2 my-auto">
                    <span class="badge badge-pill badge-primary p-2" v-if="enrollment.status == 0">In Progress</span>
                    <span class="badge badge-pill badge-success p-2" v-else-if="enrollment.status == 1">Accepted</span>
                    <span class="badge badge-pill badge-danger p-2" v-else>Rejected</span>
                </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script src="../composables/library"></script>

<style>
    a:hover{
        cursor: pointer;
    }
    img:hover {
    cursor: crosshair;
    }

</style>