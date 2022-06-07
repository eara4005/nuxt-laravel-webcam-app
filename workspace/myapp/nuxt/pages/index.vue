<template>
  <v-container pt-4>
        <v-row justify="center">
            <v-cols cols="12" sm="6" md="6">
              <h1>This is Nuxt Project</h1>
              <p>{{data}}</p>
            </v-cols>
        </v-row>
  </v-container>
</template>

<script>
import Logo from '~/components/VuetifyLogo.vue'

export default {
  components: {
    Logo
  },
  async asyncData(app) {
    const da = await app.$axios.$get('http://localhost:18080/api/upload')
    const data = da
    return {
      data
    }
  }
}
</script>