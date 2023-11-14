<template>
  <div class="sp-header-contents">
    <div class="register-btn-wrapper" v-if="!isLoginStatus">
      <AtomUserRegisterButtonText />
    </div>
    <div class="sp-login-btn-wrapper" v-if="!isLoginStatus">
      <AtomUserLoginLinkIcon />
    </div>
    <div
      v-if="isLoginStatus"
      class="sp-logout-btn-wrapper mr-4"
      @click="$emit('userLogout')"
    >
      <AtomUserLogoutLinkIcon />
    </div>
    <div>
      <AtomHamburgerIcon
        @toggle-hamburger-menu="
          $emit('toggleHamburgerMenu')
        "
      />
    </div>
  </div>
</template>

<script setup>
import AtomUserRegisterButtonText from '../../atoms/button/AtomUserRegisterButtonText.vue';
import AtomUserLoginLinkIcon from '../../atoms/icon/AtomUserLoginLinkIcon.vue';
import AtomUserLogoutLinkIcon from '../../atoms/icon/AtomUserLogoutLinkIcon.vue';
import AtomHamburgerIcon from '../../atoms/icon/AtomHamburgerIcon.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits([
  'userLogout',
  'toggleHamburgerMenu',
]);
</script>
