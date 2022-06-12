<template>
  <div class="container">
    <h1 class="h1 pb-1 border-bottom border-dark">Login</h1>
    <div class="row justify-content-md-center">
      <div class="col-6">
        <form name="login" @submit.prevent="login()">
          <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="name" class="form-control" id="name" placeholder="ユーザー名を入力してください" v-model="form.name"/>
            <div class="alert alert-danger" v-text="errors.name" v-if="errors.name"></div>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="パスワードを入力してください" v-model="form.password"/>
            <div class="alert alert-danger" v-text="errors.password" v-if="errors.password"></div>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          name: '',
          password: ''
        },
        errors: {},
      };
    },
    mounted() {
    },
    methods: {
      async login() {
        this.errors = {};
        var self = this;
        try {
          const response = await this.$auth.loginWith('local', { data: this.form });
          console.log(response);

        } catch(error) {
          console.log(error);
          var responseErrors = error.response.data.errors;
          var errors = {};

          for(var key in responseErrors) {
              errors[key] = responseErrors[key][0];
          }
          self.errors = errors;
        }
      },

    },
  };
</script>