<template>
  <v-app-bar app dark>
    
    <AppBarLogo name="CMP Gaming" image="cmp-logo.png"/>

    <AppBarMenu/>

    <v-spacer></v-spacer>

    <AppBarThemeToggler/>

  </v-app-bar>
</template>

<script>
import AppBarLogo from "@/components/AppBarLogo";
import AppBarMenu from "@/components/AppBarMenu";
import AppBarThemeToggler from "@/components/AppBarThemeToggler";

export default {
  name: "AppBar",

  components: {
    AppBarLogo,
    AppBarMenu,
    AppBarThemeToggler
  }
};
</script>
