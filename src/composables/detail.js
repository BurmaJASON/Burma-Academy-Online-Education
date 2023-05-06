
import axios from 'axios';
import { mapGetters } from 'vuex';
import moment from 'moment';

export default {

    data() {
        return {
            courseSlug : null,
            tokenStatus : false,
            course : {},
            enrollStatement : null,
            instructor : '',
            latestCourses : [],
            categories : [],
            commentLength : null,
            body : '',
            validationError : null
        }
    },

    computed :{
        ...mapGetters(['token','userData'])
    },  

    methods: {
        formatDateTime(dateTime) {
            return moment(dateTime).fromNow();
        },

        getAllCourses() {
            
            axios.get("http://localhost:8000/api/courses").then((response) => {
                // getting Filter course
                const filteredCourse = response.data.allCourses.find(course => course.slug === this.courseSlug);
                if (filteredCourse) {
                    if(filteredCourse.image != null) {
                    filteredCourse.image = 'http://localhost:8000/storage/courseImage/' + filteredCourse.image;
                    } else {
                    filteredCourse.image = 'http://localhost:8000/assets/imgs/default.jpeg';
                    }

                     // sort comments in descending order based on createdAt property
                    filteredCourse.comments.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    this.course = filteredCourse;
                    this.instructor = this.course.instructor.user_name;
                    this.commentLength = this.course.comments.length;

                    const userId = this.userData.id;

                    axios.get(`http://localhost:8000/api/enrollments/${userId}`).then((enrollments) => {
                        const enrolledCourses = enrollments.data.enrollments.map(enrollment => enrollment.course_id);
                        const enrolledCourse = enrollments.data.enrollments.find(enrollment => enrollment.course_id === this.course.id);
                        if (enrolledCourses.includes(this.course.id) && enrolledCourse.status === 0) {
                            this.enrollStatement = false;
                        }else if (enrolledCourses.includes(this.course.id) && enrolledCourse.status === 1){
                            this.enrollStatement = true;
                        }else {
                            this.enrollStatement = null;
                        }
                    }).catch(err => console.log(err.message));
                }
            });
        },

        getLatestCourses() {
            axios.get("http://localhost:8000/api/courses").then((response) => {
                // Getting Latest 4 courses
                const latestCourse = response.data.allCourses.slice(0,4);
                latestCourse.forEach((Lcourse) => {
                    if(Lcourse.image != null) {
                        Lcourse.image = 'http://localhost:8000/storage/courseImage/' + Lcourse.image;
                    }else {
                        Lcourse.image = 'http://localhost:8000/assets/imgs/default.jpeg';
                    }
                })
                this.latestCourses = latestCourse;
            });
        },

        loadCategories() {
            axios.get('http://localhost:8000/api/courses').then((response) => {
                // this.categories = response.data.categories;

                    const courses = response.data.courses;
                    const categories = response.data.categories;
                    const categoryCounts = {};

                    // Count the number of courses in each category
                    courses.forEach(course => {
                        if (categoryCounts[course.category_id]) {
                            categoryCounts[course.category_id]++;
                        } else {
                            categoryCounts[course.category_id] = 1;
                        }
                    });


                    this.categories = categories.map(category => ({
                        data: category,
                        count: categoryCounts[category.id]
                    }));

            }).catch(err => console.log(err.message));
        },

        back() {
            // history.back();
            return this.$router.push({
                name : 'courses'
            })
        },

        checkToken() {
            if(this.token !== null && this.token != undefined && this.token != '') {
                this.tokenStatus = true;
            }else {
                this.tokenStatus = false;
            }
        },

        nextCourse(slug) {
            this.$router.push({
                name : 'detail',
                query : {
                    slug : slug
                }
            })
            this.courseSlug = slug;
            this.enrollStatement = null;
            this.getAllCourses();
        },

        viewCountLoad() {
            axios.post("http://localhost:8000/api/coursesUpdate",{ courseSlug: this.$route.query.slug})
            .then((response) => {
                return response.data;
            }).catch(err => console.log(err.message))
        },

        enroll(id) {
            let data = {
                courseId: id,
                userId: this.userData.id
            };
            axios.post("http://localhost:8000/api/enroll",data)
            .then((response) => {
                this.enrollStatement = false;
                return response.data;
            }).catch(err => console.log(err.message));
        },

        cancelEnroll(id) {
            let data = {
                courseId: id,
                userId: this.userData.id
            };
            // console.log(id);
            axios.post("http://localhost:8000/api/cancelEnroll",data)
            .then((response) => {
                this.enrollStatement = null;
                return response.data;
            }).catch(err => console.log(err.message))
        },

        comment() {
            let data = {
                body : this.body,
                userId : this.userData.id,
                courseId : this.course.id
            };

            axios.post("http://localhost:8000/api/comment",data)
            .then((response) => {
                this.validationError = null;
                this.body = '';
                this.getAllCourses();
                return response.data;
            }).catch(err => {
                if (err.response.status === 422) {
                    const $valerror = Object.values(err.response.data.errors)[0].shift();
                    this.validationError  = $valerror;
                  }
            })

        }
    },

    mounted() {
        this.getAllCourses();
        this.courseSlug = this.$route.query.slug;
        this.checkToken();
        this.getLatestCourses();
        this.loadCategories();
        this.viewCountLoad();
    },
}
