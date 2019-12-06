<template>
  <parallax 
    :image="require('../assets/m4a3.jpg')" 
    header="profile"
    sheet
  />
</template>


<script>
import parallax from '@/components/ParallaxComponent';

export default {
  name: 'Profile',

  components: {
    parallax
  },

  data: () => ({
    //
  }),
};
</script>
