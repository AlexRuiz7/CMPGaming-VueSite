<template>
  <parallax 
    :image="require('../assets/home.jpg')" 
    header="Welcome to CMP Gaming"
    text="COMMUNITY BASED GAMING"
    :height="800"
    sheet
  />
</template>


<script>
import parallax from '@/components/ParallaxComponent';

export default {
  name: 'Home',

  components: {
    parallax
  },

  data: () => ({
    //
  }),
};
</script>