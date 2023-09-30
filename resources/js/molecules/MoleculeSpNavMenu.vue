<template>
  <div class="sp-header-contents">
    <AtomUserRegisterButtonText v-if="!isLoginStatus" />
    <AtomUserLoginLinkIcon v-if="!isLoginStatus" />
    <AtomHamburgerIcon @toggle-hamburger-menu="$emit('toggleHamburgerMenu')" />
  </div>
</template>

<script setup>
import AtomUserRegisterButtonText from '../atoms/AtomUserRegisterButtonText.vue';
import AtomUserLoginLinkIcon from '../atoms/AtomUserLoginLinkIcon.vue';
import AtomHamburgerIcon from '../atoms/AtomHamburgerIcon.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
});
defineEmits(['toggleHamburgerMenu']);
</script>
