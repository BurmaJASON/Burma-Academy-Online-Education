<template>
  <MasterView >
    <HeaderView></HeaderView>
    <DetailView></DetailView>
  </MasterView>
</template>

<script>
import DetailView from '../components/DetailView'
import HeaderView from '../components/HeaderView'
import MasterView from '../components/MasterView'
export default {
  components: {
    DetailView,
    HeaderView, MasterView },

}
</script>

<style>

</style>