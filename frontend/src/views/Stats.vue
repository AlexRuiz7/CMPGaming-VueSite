<template>
  <parallax 
    :image="require('../assets/m4a3.jpg')" 
    header="stats"
    sheet
  />
</template>


<script>
import parallax from '@/components/ParallaxComponent';

export default {
  name: 'Stats',

  components: {
    parallax
  },

  data: () => ({
    //
  }),
};
</script>