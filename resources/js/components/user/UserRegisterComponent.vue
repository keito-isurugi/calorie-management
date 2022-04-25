<template>
  <div class="container">
    <div class="mb-3">
      <label for="user-name" class="form-label">ユーザー名</label>
      <input type="text" class="form-control" id="user-name" v-model="user.name">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" id="email" v-model="user.email">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">パスワード</label>
      <input type="password" class="form-control" id="password" v-model="user.password">
    </div>
    <div class="mb-3">
      <label for="password-confirm" class="form-label">パスワード(確認)</label>
      <input type="password" class="form-control" id="password-confirm">
    </div>
    <!-- <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">ログイン状態を保存する</label>
    </div> -->
    <button type="button" class="btn btn-primary" @click="register()">登録</button>
  </div>
  <p>{{ user.name }}</p>
  <p>{{ user.email }}</p>
  <p>{{ user.password }}</p>
  <p>{{ user }}</p>
</template>

<script>
  export default{
    data: function(){
      return {
        user: {}
      }
    },
    methods: {
      register() {
        axios.post('/api/register', this.user)
          .then((res) => {
            this.$router.push({name: 'food.list'});
          })
          .catch(error => {
            console.log(error)
          })
      },
    },
  }
</script>