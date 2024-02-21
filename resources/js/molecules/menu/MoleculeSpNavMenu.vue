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
      class="sp-logout-btn-wrapper mr-6"
      @click="$emit('userLogout')"
    >
      <AtomUserLogoutLinkIcon />
    </div>
    <div
      class="hamburger_btn"
      @click="emit('setHamburgerMenuToggle')"
    >
      <span
        class="line line-first"
        :class="{ 'btn-line-first': hamburgerMenuToggle }"
      ></span>
      <span
        class="line line-second"
        :class="{ 'btn-line-second': hamburgerMenuToggle }"
      ></span>
      <span
        class="line line-third"
        :class="{ 'btn-line-third': hamburgerMenuToggle }"
      ></span>
    </div>
  </div>
</template>

<script setup>
import AtomUserRegisterButtonText from '../../atoms/button/AtomUserRegisterButtonText.vue';
import AtomUserLoginLinkIcon from '../../atoms/icon/AtomUserLoginLinkIcon.vue';
import AtomUserLogoutLinkIcon from '../../atoms/icon/AtomUserLogoutLinkIcon.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
  hamburgerMenuToggle: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits([
  'userLogout',
  'setHamburgerMenuToggle',
]);
</script>

<style lang="scss" scoped>
.hamburger_btn {
  width: 27px;
  height: 60px;
  cursor: pointer;
  z-index: 50;
}

.hamburger_btn .line {
  position: absolute;
  top: 0;
  width: 27px;
  height: 2px;
  background: #ffffff;
  text-align: center;
}

.hamburger_btn .line-first {
  top: 20px;
  transition: 0.4s ease;
}
.hamburger_btn .line-second {
  top: 30px;
  transition: 0.4s ease;
}
.hamburger_btn .line-third {
  top: 40px;
  transition: 0.4s ease;
}

.btn-line-first {
  transform: translateY(10px) rotate(-45deg);
  transition: 0.4s ease;
}
.btn-line-second {
  transition: 0.4s ease;
  opacity: 0;
}
.btn-line-third {
  transform: translateY(-10px) rotate(45deg);
  transition: 0.4s ease;
}
</style>
