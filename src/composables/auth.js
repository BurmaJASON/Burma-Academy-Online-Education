import axios from "axios"
// import { mapGetters } from "vuex";

export default {
    data() {
        return {
            loginStatus :  false,
            loginData : {
                email : '',
                password : ''
            },
            registerData : {
                name : '',
                email : '',
                password : '',
            },
            loginError : false,
            registerError : false,
            validationErrors : null,

        }
    },

    // computed: {
    //     ...mapGetters(['token','userData']),
    // },

    methods : {
        loginPage() {
            this.loginStatus = true;
        },

        login() {
            axios
            .post("http://localhost:8000/api/login",this.loginData)
            .then((response) => {
                if(response.data.token == null) {
                    this.loginError = true;
                }else {
                    this.loginData.email = "";
                    this.loginData.password = "";
                    this.storeUserInfo(response);
                    this.$router.push({
                        name : 'home',
                    })
                }
            })
            .catch(err => console.log(err.message));
        },

        register() {
            axios
            .post("http://localhost:8000/api/register",this.registerData)
            .then((response) => {
                if(response.data.token == null) {
                    this.registerError = true;
                }else {
                    this.registerData.name = "";
                    this.registerData.email = "";
                    this.registerData.password = "";
                    this.storeUserInfo(response);
                    this.$router.push({
                        name : 'home',
                    });
                    this.validationErrors = '';
                }
            })
            .catch(error => {
                if (error.response.status === 422) {
                  const $valerror = Object.values(error.response.data.errors)[0].shift();
                  this.validationErrors  = $valerror;
                  this.userStatus = true;
                }
            });
        },

        storeUserInfo(response) {
            this.$store.dispatch("setToken", response.data.token);
            this.$store.dispatch("setUserData", response.data.user);
        },
    }
}