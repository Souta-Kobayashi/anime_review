<template>
  <form @submit.prevent="registerUser">
    <div>
      <label for="name">Name</label>
      <input v-model="form.name" type="text" id="name" name="name">
    </div>
    <div>
      <label for="email">Email</label>
      <input v-model="form.email" type="email" id="email" name="email" autocomplete="username">
    </div>
    <div>
      <label for="password">Password</label>
      <input v-model="form.password" type="password" id="password" name="password" autocomplete="new-password">
    </div>
    <div>
      <label for="password_confirmation">Confirm Password</label>
      <input v-model="form.password_confirmation" type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
    </div>
    <div>
      <button type="submit">Register</button>
    </div>
  </form>
</template>

<script setup>
import { reactive } from 'vue';
// import axios from 'axios';

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const registerUser = async () => {
  try {
    const response = await axios.post('/api/register', form);
    console.log(response.data); // 登録成功時のレスポンス
  } catch (error) {
    console.log('err');
    console.error(error); // エラーハンドリング
  }
};

</script>