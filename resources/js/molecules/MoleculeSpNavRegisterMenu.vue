<template>
  <li class="sp-menu-item" @click="toggleRegisterItem = !toggleRegisterItem">
    <a href="#"
      >登録メニュー<v-icon icon="mdi-triangle-small-down" size="small"
    /></a>
    <Transition
      name="show-hamburger-inner"
      @enter="e => $emit('showHamburgerInner', e)"
      @leave="e => $emit('closeHamburgerInner', e)"
    >
      <ul v-show="toggleRegisterItem" class="register-item-wrapper" @click.stop>
        <AtomMenuLink
          v-for="(item, key) in registerItems"
          :key="key"
          :href="item.href"
          li-class-name="register-item"
        >
          <v-icon
            class="rotate-r90"
            icon="mdi-triangle-small-down"
            size="small"
          />
          {{ item.title }}
        </AtomMenuLink>
      </ul>
    </Transition>
  </li>
</template>

<script setup>
import { ref } from 'vue';
import AtomMenuLink from '../atoms/AtomMenuLink.vue';

const props = defineProps({
  initialToggleRegisterItem: {
    type: Boolean,
    default: true,
  },
});

const emit = defineEmits(['showHamburgerInner', 'closeHamburgerInner']);

const toggleRegisterItem = ref(props.initialToggleRegisterItem);
const registerItems = {
  register: {
    title: 'アニメ登録',
    href: '/anime/create',
  },
  anime: {
    title: 'カテゴリ登録',
    href: '/category/create',
  },
};
</script>

<style lang="scss">
.show-hamburger-inner-enter-from {
  opacity: 0;
}
.show-hamburger-inner-enter-active {
  transition: opacity 0.15s;
}
.show-hamburger-inner-enter-to {
  opacity: 1;
}
.show-hamburger-inner-leave-active {
  transition: opacity 0.15s;
  opacity: 0;
}
</style>
