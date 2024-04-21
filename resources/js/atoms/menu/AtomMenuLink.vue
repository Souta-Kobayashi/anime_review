<template>
  <li :class="liClassName">
    <RouterLink
      :to="href"
      :class="aClassName"
      active-class="text-white"
    >
      <slot></slot>
    </RouterLink>
  </li>
</template>

<script setup>
defineProps({
  href: {
    type: String,
    default: "",
  },
  liClassName: {
    type: String,
    default: "",
  },
  aClassName: {
    type: String,
    default: "",
  },
});
</script>
