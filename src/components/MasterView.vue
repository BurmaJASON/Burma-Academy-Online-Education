<template>
    <div>
        <!-- NavView -->
        <NavView></NavView>

        <!-- Main -->
        <slot></slot>

        <!-- Footer -->
        <FooterView></FooterView>

    </div>
</template>

<script>
import FooterView from './FooterView'
import NavView from './NavView'
export default {
  components: {
    FooterView, NavView },

    

}
</script>

<style>

</style>