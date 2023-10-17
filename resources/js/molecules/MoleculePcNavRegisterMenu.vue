<template>
  <li class="menu-item has-child">
    <a class="d-block menu-link"
      >登録メニュー<v-icon
        icon="mdi-triangle-small-down"
        size="small"
    /></a>
    <ul class="child-menu-wrapper">
      <AtomMenuLink
        v-for="(item, key) in registerItems"
        :key="key"
        :href="item.href"
        li-class-name="child-menu-item"
      >
        {{ item.title }}
      </AtomMenuLink>
    </ul>
  </li>
</template>

<script setup>
import AtomMenuLink from '../atoms/AtomMenuLink.vue';
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
a {
  cursor: pointer;
}
</style>
