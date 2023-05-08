
import axios from 'axios';

export default {
    data() {
        return {
            categories : [],
            showBackToTop: true,
        }
    },
    mounted() {
        this.loadCategories();
    },

    
    methods: {
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        loadCategories() {
            axios.get('http://localhost:8000/api/courses').then((response) => {
                this.categories = response.data.categories;
            }).catch(err => console.log(err.message));
        },
    },

}
