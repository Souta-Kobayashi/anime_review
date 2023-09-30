<template>
  <div class="user-menu-wrapper">
    <div class="register-wrapper">
      <AtomUserRegisterButtonWithIcon />
    </div>
    <div>
      <AtomUserLoginButtonWithIcon />
    </div>
  </div>
</template>

<script setup>
import AtomUserRegisterButtonWithIcon from '../atoms/AtomUserRegisterButtonWithIcon.vue';
import AtomUserLoginButtonWithIcon from '../atoms/AtomUserLoginButtonWithIcon.vue';
</script>
