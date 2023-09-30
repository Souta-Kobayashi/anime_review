<template>
  <div class="container p-3 sns-wrapper">
    <ul class="d-flex justify-content-center p-0">
      <li class="mr-12">
        <AtomIconLink
          href="https://twitter.com/soutaAppservice"
          mdiIcon="mdi-twitter"
        />
      </li>
      <li>
        <AtomIconLink
          href="https://github.com/Souta-Kobayashi"
          mdiIcon="mdi-github"
        />
      </li>
    </ul>
  </div>
</template>

<script setup>
import AtomIconLink from '../atoms/AtomIconLink.vue';
</script>
