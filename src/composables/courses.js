import axios from 'axios';
import Fuse from 'fuse.js';
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";

export default {
    data() {
        return {
            allCourses : [],
            coursesList :[],
            currentCategory : null,
            categories : [],
            keyword : '',
            displayedCourses : [],
            page : 1,
            pageCount : null,
            paginate : true,
        }
    },

    components: {
        VPagination
    },
    
    methods: {
        getAllCourses() {

            // Get paginated courses
            axios.get('http://localhost:8000/api/courses?page=' + this.page).then((response) => {

                for(let i = 0; i< response.data.courses.data.length; i++) {
                    if(response.data.courses.data[i].image != null) {
                        response.data.courses.data[i].image = 'http://localhost:8000/storage/courseImage/' + response.data.courses.data[i].image;
                    }else {
                        response.data.courses.data[i].image = 'http://localhost:8000/assets/imgs/default.jpeg';
                    }
                }

                this.pageCount = response.data.pageCount;

                this.coursesList = response.data.courses.data;
            });

            // get All courses
            axios.get('http://localhost:8000/api/courses').then((response) => {
                for(let i = 0; i< response.data.allCourses.length; i++) {
                    if(response.data.allCourses[i].image != null) {
                        response.data.allCourses[i].image = 'http://localhost:8000/storage/courseImage/' + response.data.allCourses[i].image;
                    }else {
                        response.data.allCourses[i].image = 'http://localhost:8000/assets/imgs/default.jpeg';
                    }
                }
                this.allCourses = response.data.allCourses;
            });


        },

        loadCategories() {
            axios.get('http://localhost:8000/api/courses').then((response) => {
                this.categories = response.data.categories;
            }).catch(err => console.log(err.message));
        },

        setCurrentCategory(category) {
            if (category == null ) {
                this.currentCategory = null;
              } else {
                this.currentCategory = category.name;
              }
        },

        searchCourses() {
            let filteredCourses = this.allCourses;
            const keyword = this.keyword ? this.keyword.toLowerCase() : '';
            if (this.currentCategory !== null) {
                filteredCourses = filteredCourses.filter(course => course.category && course.category.name === this.currentCategory);
                this.displayedCourses = filteredCourses;
                this.paginate = false;
            }
            if(this.currentCategory === null){
                this.displayedCourses = this.allCourses;
                this.paginate = true;
            }

            if (keyword) {
                const options = {
                    keys: [
                        'title', 
                        'category.name',
                        'instructor.user_name'
                    ],
                    threshold: 0.3
                };
                const fuse = new Fuse(filteredCourses, options);
                filteredCourses = fuse.search(keyword).map(result => result.item);
                this.displayedCourses = filteredCourses;
                this.paginate = false;
            } 
        },

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
        this.getAllCourses();
        this.loadCategories();
    },
}