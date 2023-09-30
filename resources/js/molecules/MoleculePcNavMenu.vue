<template>
  <AtomMenuLink
    v-for="(item, key) in navigationItems"
    :key="key"
    :href="item.href"
    li-class-name="menu-item"
    a-class-name="d-block menu-link"
  >
    {{ item.title }}
  </AtomMenuLink>
</template>

<script setup>
import AtomMenuLink from '../atoms/AtomMenuLink.vue';

const navigationItems = {
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
