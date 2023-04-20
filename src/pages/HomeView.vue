<template>
  <MasterView>
    
    <HeaderView></HeaderView>

    <AboutView></AboutView>

    <SignUp v-if="!tokenStatus"></SignUp>

    <ContactView></ContactView>

  </MasterView>
 
      

</template>

<script>


import ContactView from '../components/ContactView'
import SignUp from '../components/SignUp'
import AboutView from '../components/AboutView'
import HeaderView from '../components/HeaderView'
import MasterView from '../components/MasterView'


import { mapGetters } from 'vuex'

export default {
  components: {
    ContactView,
    SignUp,
    AboutView,
    HeaderView, MasterView 
  },

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
    }
  },

  mounted() {
    this.checkToken();
  }
}

</script>
