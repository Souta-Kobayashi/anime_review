<template>
  <div class="sp-header-contents">
    <AtomUserRegisterButtonText v-if="!isLoginStatus" />
    <AtomUserLoginLinkIcon v-if="!isLoginStatus" />
    <div
      v-if="isLoginStatus"
      class="sp-logout-btn-wrapper mr-4"
      @click="$emit('userLogout')"
    >
      <AtomUserLogoutLinkIcon />
    </div>
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
