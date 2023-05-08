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


    methods : {
        loginPage() {
            this.loginStatus = true;
        },


        async login() {
            try {
              const response = await axios.post("http://localhost:8000/api/login", this.loginData);
              if (response.data.token == null) {
                this.loginError = true;
              } else {
                this.loginData.email = "";
                this.loginData.password = "";
                await this.storeUserInfo(response);
                this.$router.push({
                  name: "home",
                });
              }
            } catch (error) {
              console.log(error.message);
            }
          },
          

        async register() {
            try {
              const response = await axios.post("http://localhost:8000/api/register", this.registerData);
              if (response.data.token == null) {
                this.registerError = true;
              } else {
                this.registerData.name = "";
                this.registerData.email = "";
                this.registerData.password = "";
                await this.storeUserInfo(response);
                this.$router.push({
                  name: "home",
                });
                this.validationErrors = "";
              }
            } catch (error) {
              if (error.response.status === 422) {
                const $valerror = Object.values(error.response.data.errors)[0].shift();
                this.validationErrors = $valerror;
                this.userStatus = true;
              }
            }
          },
          

        storeUserInfo(response) {
            this.$store.dispatch("setToken", response.data.token);
            this.$store.dispatch("setUserData", response.data.user);
        },
    }
}