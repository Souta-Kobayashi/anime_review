<template>
  <div class="sp-header-contents">
    <AtomUserRegisterButtonText v-if="!isLoginStatus" />
    <AtomUserLoginLinkIcon v-if="!isLoginStatus" />
    <AtomUserLogoutLinkIcon
      v-if="isLoginStatus"
      @user-logout="$emit('userLogout')"
    />
    <AtomHamburgerIcon @toggle-hamburger-menu="$emit('toggleHamburgerMenu')" />
  </div>
</template>

<script setup>
import AtomUserRegisterButtonText from '../atoms/AtomUserRegisterButtonText.vue';
import AtomUserLoginLinkIcon from '../atoms/AtomUserLoginLinkIcon.vue';
import AtomUserLogoutLinkIcon from '../atoms/AtomUserLogoutLinkIcon.vue';
import AtomHamburgerIcon from '../atoms/AtomHamburgerIcon.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits(['userLogout', 'toggleHamburgerMenu']);
</script>
