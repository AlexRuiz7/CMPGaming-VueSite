<template>
    <v-btn icon @click="toggleTheme">
      <v-icon>mdi-theme-light-dark</v-icon>
    </v-btn>
</template>

<script>
export default {
    name: 'AppBarThemeToggler',

    methods: {

        toggleTheme() {
            this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
        }
    }
}
</script>