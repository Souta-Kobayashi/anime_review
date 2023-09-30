<template>
  <Transition
    name="show-hamburger"
    @enter="e => $emit('showHamburger', e)"
    @leave="e => $emit('closeHamburger', e)"
  >
    <div
      v-show="toggleHamburgerMenu"
      ref="hamburgerContents"
      id="hamburgerContents"
      class="container hamburger-contents"
    >
      <div>
        <ul class="sp-menu-wrapper">
          <AtomMenuLink
            v-for="(item, key) in hamburgerItems"
            :key="key"
            :href="item.href"
            li-class-name="sp-menu-item"
          >
            {{ item.title }}
          </AtomMenuLink>
          <MoleculeSpNavRegisterMenu
            v-if="isLoginStatus"
            :initial-toggle-register-item="initialToggleRegisterItem"
            @show-hamburger-inner="e => $emit('showHamburgerInner', e)"
            @close-hamburger-inner="e => $emit('closeHamburgerInner', e)"
          />
        </ul>
      </div>
    </div>
  </Transition>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AtomMenuLink from '../atoms/AtomMenuLink.vue';
import MoleculeSpNavRegisterMenu from '../molecules/MoleculeSpNavRegisterMenu.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
  toggleHamburgerMenu: {
    type: Boolean,
    default: false,
  },
  initialToggleRegisterItem: {
    type: Boolean,
    default: true,
  },
});

const emit = defineEmits([
  'setHamburgerContents',
  'showHamburger',
  'closeHamburger',
  'showHamburgerInner',
  'closeHamburgerInner',
]);

const hamburgerContents = ref(null);
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

onMounted(() => {
  emit('setHamburgerContents', hamburgerContents);
});
</script>

<style lang="scss">
.show-hamburger-enter-from {
  height: 0;
  opacity: 0;
}
.show-hamburger-enter-to {
  opacity: 1;
}
.show-hamburger-leave-active {
  opacity: 0;
}
</style>
