<template>
  <v-container pt-4 max-width="500">
    <v-row justify="center" class="align-center">
      <v-col cols="8" md="8">
        <h1 class="h2 pb-1 border-bottom border-dark" align="center">
          顔登録システム-ログイン
        </h1>
        <form name="login" @submit.prevent="login()">
          <div class="form-group">
            <label for="name">ユーザー名</label>
            <v-text-field type="name" class="shrink mx-4" id="name" outlined v-model="form.name" :rules="[required]" />
          </div>
          <div class="form-group">
            <label for="password">パスワード</label>
            <v-text-field type="password" class="shrink mx-4" id="password" outlined v-model="form.password"
              :rules="[required]" />
          </div>
          <v-alert type="error" v-text="errors.name" v-if="errors.name"></v-alert>
          <v-alert type="error" v-text="errors.password" v-if="errors.password"></v-alert>
          <div align="center">
            <v-btn color="primary" type="submit" class="btn btn-success" :disabled="activeBtn">ログイン</v-btn>
          </div>
        </form>
        <Caption></Caption>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Caption from "../components/Caption.vue";
export default {
  conponent: {
    Caption,
  },

  data() {
    return {
      form: {
        name: "",
        password: "",
      },
      nullFlg: false,
      required: (value) => !!value || "必ず入力してください", // 入力必須の制約
      errors: {},
    };
  },
  computed: {
    activeBtn() {
      if (this.form.name != "" && this.form.password != "") {
        return false;
      } else {
        return true;
      }
    },
  },
  mounted() {},
  methods: {
    async login() {
      this.errors = {};
      var self = this;
      // ローディング処理完了
      this.$nuxt.$loading.start()
      try {
        const response = await this.$auth.loginWith("local", {
          data: this.form,
        });
        console.log(response);
      } catch (error) {
        console.log(error);
        var responseErrors = error.response.data.errors;
        var errors = {};

        for (var key in responseErrors) {
          errors[key] = responseErrors[key][0];
        }
        self.errors = errors;
      }
      // ローディング処理終了
      this.$nuxt.$loading.finish()
    },
  },
};
</script>
