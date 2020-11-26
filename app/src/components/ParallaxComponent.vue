<template>
    <v-row 
      align="center" 
      justify="center" 
      no-gutters
    >
        <v-col 
          class="text-center" 
          cols="12"
        >
        <v-parallax
          :height="height"
          :src="image"
        >
        <v-row 
          align="center" 
          justify="center"
        >
          <v-col 
            class="text-center" 
            cols="12"
          >
            <v-sheet 
                v-if="sheet"
                color="rgba(43, 43, 43, 0.6)"
                tile
            >
              <h1 
                class="display-1 font-weight-thin mb-4 white--text"
                v-text="formattedHeader"
              />
              <h4 class="subheading white--text">{{text}}</h4>
            </v-sheet>
            <template v-else>
              <h1 
                class="display-1 font-weight-thin mb-4 white--text"
                v-text="formattedHeader"
              />
              <h4 
                class="subheading white--text">{{text}}</h4>
            </template>
          </v-col>
        </v-row>
      </v-parallax>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'Parallax',

  props: {
    header: {
      type: String,
      default: "default"
    },
    text: {
      type: String,
      default: "This place is currently under development"
    },
    image: String,
    height: {
      type: [Number, String],
      // default: '1000'
    },
    sheet: {
      type: Boolean,
      default: false
    },
    no_format: {
      type: Boolean,
      default: false
    }
  },

  methods: {
    toUpperCase(value) {
      return value.toString().toUpperCase();
    }
  },

  computed: {
    formattedHeader() {
      return (this.no_format) ? this.header : this.toUpperCase(this.header);
    }
  }
};
</script>