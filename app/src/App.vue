<template>
  <v-app id>
    <AppBar/>

    <v-main app>
      <v-container fluid>
        <v-fade-transition mode="out-in">
          <router-view></router-view>
        </v-fade-transition>
      </v-container>
    </v-main>      

  </v-app>
</template>

<script>
import AppBar from '@/components/AppBar';

export default {
  name: 'App',

  components: {
    AppBar
  },

  data: () => ({
    //
  }),
};
</script>
