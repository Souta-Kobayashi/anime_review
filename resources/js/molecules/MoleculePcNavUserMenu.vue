<template>
  <div v-if="!isLoginStatus" class="user-menu-wrapper">
    <div class="register-wrapper">
      <AtomUserRegisterButtonWithIcon />
    </div>
    <div>
      <AtomUserLoginButtonWithIcon />
    </div>
  </div>
  <AtomUserLogoutButtonWithIcon
    v-if="isLoginStatus"
    @user-logout="$emit('userLogout')"
  />
</template>

<script setup>
import AtomUserRegisterButtonWithIcon from '../atoms/AtomUserRegisterButtonWithIcon.vue';
import AtomUserLoginButtonWithIcon from '../atoms/AtomUserLoginButtonWithIcon.vue';
import AtomUserLogoutButtonWithIcon from '../atoms/AtomUserLogoutButtonWithIcon.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['userLogout']);
</script>
