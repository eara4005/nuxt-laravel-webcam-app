<template>
  <v-app>
    <v-app-bar :clipped-left="clipped" fixed app>
      <v-toolbar-title>
        WebCam App
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click=" $nuxt.$loading.start(); $auth.logout(); ">
        ログアウト
      </v-btn>
    </v-app-bar>
    <v-main>
      <v-container>
        <Nuxt />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'DefaultLayout',
  data () {
    return {
      title: 'Vuetify.js'
    }
  },
}
</script>
