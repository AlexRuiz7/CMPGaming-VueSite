<template>
    <div class="d-flex align-center mr-2" style="width: 20%">
        <v-img
            :alt="logoAlt"
            class="shrink mr-2"
            contain
            src="@/assets/cmp-logo.png"
            transition="scale-transition"
            width="90"
            height="70"
        />
        <div class="font-weight-black"> {{ name }} </div>
    </div>
</template>

<script>
export default {
    name: 'AppBarLogo',

    props: {
        image: String,
        name: String
    },

    computed: {
        logoAlt() {
            return `${this.name} Logo`;
        },

        logoPath() {
            return `@/assets/${this.image}`;
        }
    }
}
</script>