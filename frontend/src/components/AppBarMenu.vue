<template>
    <v-card
        tile flat 
        width="70%" min-width="50%" max-height="100%"
        class="d-flex"
    >

        <v-card
            v-for="link in links" :key="link.to"
            :to="link.to"
            :width="linkWidth + '%'"
            v-text="link.to"
            tile
            hover
            dark
            class="pa-4 text-center text-uppercase font-weight-bold text-no-wrap text-truncate"
            active-class="red darken-4"
        />

    </v-card>
</template>

<script>
export default {
    name: 'AppBarMenu',
    
    data: () => ({
        links: [
            {to: 'home',    active: 'false'},
            {to: 'profile', active: 'false'},
            {to: 'servers', active: 'true' },
            {to: 'stats',   active: 'false'},
        ]
    }),

    computed: {
        linkWidth() {
            return 100 / this.links.length;
        }
    }
}
</script>