<template>
  <li class="sp-menu-item">
    <span class="sp-menu-register-title"
      >登録メニュー<v-icon
        icon="mdi-triangle-small-down"
        size="small"
    /></span>
    <ul>
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
  </li>
</template>

<script setup>
import AtomMenuLink from '../../atoms/menu/AtomMenuLink.vue';

const emit = defineEmits([
  'showHamburgerInner',
  'closeHamburgerInner',
]);

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

<style lang="scss" scoped>
.sp-menu-register-title {
  display: block;
  margin: 0 0 10px 0;
}
.register-item {
  margin: 0 0 10px 0;
}
</style>
