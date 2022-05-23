<template>
  <div class="container">
    <div>
      <logo />
      <h1 class="title">
        {{data}}
      </h1>
      <h2 class="subtitle">
        My Nuxt.js index project
      </h2>
      <div class="links">
        <a
          href="https://nuxtjs.org/"
          target="_blank"
          class="button--green"
        >
          Documentation
        </a>
        <a
          href="https://github.com/nuxt/nuxt.js"
          target="_blank"
          class="button--grey"
        >
          GitHub
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import Logo from '~/components/VuetifyLogo.vue'

export default {
  components: {
    Logo
  },
  async asyncData(app) {
    const da = await app.$axios.$get('http://localhost:18080/api/upload')
    const data = da.index
    return {
      data
    }
  }
}
</script>