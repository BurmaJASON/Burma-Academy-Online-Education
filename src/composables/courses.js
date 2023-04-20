import axios from 'axios';
import Fuse from 'fuse.js';

export default {
    data() {
        return {
            coursesList :[],
            currentCategory : null,
            categories : [],
            keyword : '',
            displayedCourses : []
        }
    },
    
    methods: {
        getAllCourses() {
            axios.get("http://localhost:8000/api/courses").then((response) => {

                for(let i = 0; i< response.data.courses.length; i++) {
                    if(response.data.courses[i].image != null) {
                        response.data.courses[i].image = 'http://localhost:8000/storage/courseImage/' + response.data.courses[i].image;
                    }else {
                        response.data.courses[i].image = 'http://localhost:8000/assets/imgs/default.jpeg';
                    }
                }

                this.coursesList = response.data.courses;
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
            let filteredCourses = this.coursesList;
            const keyword = this.keyword ? this.keyword.toLowerCase() : '';
            if (this.currentCategory !== null) {
                filteredCourses = filteredCourses.filter(course => course.category && course.category.name === this.currentCategory);
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
            } 
            this.displayedCourses = filteredCourses;
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