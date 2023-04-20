import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            enrollments :[],
            selectedTab: 'all',
        }
    },

    computed :{
        ...mapGetters(['userData']),
        filteredEnrollments() {
            switch (this.selectedTab) {
              case 'pending':
                return this.enrollments.filter(enrollment => enrollment.status === 0);
              case 'accepted':
                return this.enrollments.filter(enrollment => enrollment.status === 1);
              case 'rejected':
                return this.enrollments.filter(enrollment => enrollment.status === 2);
              default:
                return this.enrollments;
            }
        } 
    }, 

    methods : {
        getEnrollments() {
            const userId = this.userData.id;
            axios.get(`http://localhost:8000/api/enrollments/${userId}`).then((response) => {
                for(let i = 0; i< response.data.enrollments.length; i++) {
                    const course = response.data.enrollments[i].course;
                    if(course.image != null) {
                        course.image = 'http://localhost:8000/storage/courseImage/' + course.image;
                    }else {
                        course.image = 'http://localhost:8000/assets/imgs/default.jpeg';
                    }
                }
                this.enrollments = response.data.enrollments;
            })
        },

        // pendingEnrollments() {
        //     this.enrollments = this.enrollments.filter(enrollment => enrollment.status === 0);
        // },
        // acceptedEnrollments() {
        //     this.enrollments = this.enrollments.filter(enrollment => enrollment.status === 1);
        // },

        // rejectedEnrollments() {
        //     this.enrollments = this.enrollments.filter(enrollment => enrollment.status === 2);
        // },
          

        courseDetail(slug) {
            this.$router.push({
                name : 'detail',
                query : {
                    slug : slug
                },
            })
        }
    },

    mounted() {
        this.getEnrollments();
    }
}