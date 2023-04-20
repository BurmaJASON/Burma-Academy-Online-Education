import { mapGetters } from 'vuex';

export default {
    data() {
    return  {
      tokenStatus : false
    }
  },

  computed : {
    ...mapGetters(["token"])
  },

  methods: {
    checkToken() {
      if(this.token != null && this.token != undefined && this.token != '') {
        this.tokenStatus = true;
      }else {
        this.tokenStatus = false;
      }
    },
    
    logout() {
        this.$store.dispatch('setToken',null);
        this.$router.push({
            name : 'signUp'
        })
    }
  },

  mounted() {
    this.checkToken();
  }

}