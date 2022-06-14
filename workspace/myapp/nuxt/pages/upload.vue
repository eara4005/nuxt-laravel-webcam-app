<template>
  <v-container pt-4>
    <v-row justify="center" class="align-center">
      <v-col cols="8" md="8" min-width="500" align="center">
        <div class="headers">
          <h1 class="h2 pb-1 border-bottom border-dark">登録する</h1>
          <h3 class="my-4 username">ログインユーザー: </h3>
          <h2 class="my-4 username" ref="username">{{ userName }}</h2>
        </div>
        <p></p>
        <div class="captions">
          <p>※まだ登録は完了しておりません。<br>
            下部の「登録する」ボタンを押下して、初めて登録が完了します。<br>
            登録後は、右上の「ログアウト」ボタンを押下してください。<br>
            （再ログインが必要になります。）
          </p>
          <div align="center">
            <v-btn color="primary" @click="storeIndexFaces" to="/upload" nuxt>登録する</v-btn>
          </div>
        </div>
      </v-col>

    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      username:'',
    }
  },
  async asyncData(app) {
    const user = await app.$axios.$get('http://localhost:18080/api/current_user')
    const userName = user.name
    return {
      userName
    }
  },
  methods: {
    async storeIndexFaces() {
      const targetElementText = this.$refs.username.textContent
      this.username = targetElementText

      const formData = new FormData();
      formData.append("name", this.username);
      await axios.post('http://localhost:18080/api/index_faces', formData)
        .then(response => {
          alert("登録が完了致しました。")
        })
        .catch(response => {
          alert('登録に失敗しました。')
        });
    },
  },
}
</script>

<style>

.username {
  display: inline;
}

</style>