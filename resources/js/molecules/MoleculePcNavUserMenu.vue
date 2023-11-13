<template>
  <div v-if="!isLoginStatus" class="user-menu-wrapper">
    <div class="register-wrapper">
      <AtomUserRegisterButtonWithIcon />
    </div>
    <div>
      <AtomUserLoginButtonWithIcon />
    </div>
  </div>
  <div
    v-else
    class="logout-btn-wrapper"
    @click="$emit('userLogout')"
  >
    <AtomUserLogoutButtonWithIcon />
  </div>
</template>

<script setup>
import AtomUserRegisterButtonWithIcon from '../atoms/button/AtomUserRegisterButtonWithIcon.vue';
import AtomUserLoginButtonWithIcon from '../atoms/button/AtomUserLoginButtonWithIcon.vue';
import AtomUserLogoutButtonWithIcon from '../atoms/button/AtomUserLogoutButtonWithIcon.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['userLogout']);
</script>
