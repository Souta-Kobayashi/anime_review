<template>
  <Transition name="sp-menu" :duration="200">
    <div
      class="sp-menu"
      v-show="hamburgerMenuToggle"
      @click.self="emit('setHamburgerMenuToggle')"
    >
      <ul class="inner">
        <AtomMenuLink
          v-for="(item, key) in hamburgerItems"
          :key="key"
          :href="item.href"
          li-class-name="sp-menu-item"
        >
          {{ item.title }}
        </AtomMenuLink>
        <MoleculeHamburgerRegisterMenu
          v-if="isLoginStatus"
        />
      </ul>
    </div>
  </Transition>
</template>

<script setup>
import AtomMenuLink from '../../atoms/menu/AtomMenuLink.vue';
import MoleculeHamburgerRegisterMenu from './MoleculeHamburgerRegisterMenu.vue';

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
const emit = defineEmits(['setHamburgerMenuToggle']);

const hamburgerItems = {
  top: {
    title: 'TOP',
    href: '/',
  },
  anime: {
    title: 'アニメ一覧',
    href: '/anime',
  },
  category: {
    title: 'カテゴリ',
    href: '/category',
  },
};
</script>

<style lang="scss" scoped>
.sp-menu {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0.8;
  background: #000;
  padding: 20px 30px;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 10;

  .sp-menu-item {
    margin: 0 0 10px 0;
  }
}
.sp-menu-enter-active,
.sp-menu-leave-active {
  transition: all 0.25s;
}
.sp-menu-enter-from,
.sp-menu-leave-to {
  opacity: 0;
}
.sp-menu-leave-from,
.sp-menu-enter-to {
  opacity: 0.8;
}

.sp-menu-enter-active .inner,
.sp-menu-leave-active .inner {
  transition: all 0.15s ease-in-out;
}

.sp-menu-enter-active .inner {
  transition-delay: 0.05s;
}
.sp-menu-enter-from .inner,
.sp-menu-leave-to .inner {
  transform: translateX(-100px);
  opacity: 0;
}
</style>
