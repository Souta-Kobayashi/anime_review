<template>
  <div class="container p-3 sns-wrapper">
    <ul class="d-flex justify-content-center p-0">
      <li class="mr-12">
        <a
          aria-label="Xに遷移する"
          href="https://twitter.com/soutaAppservice"
          target="_blank"
        >
          <i>
            <FontAwesomeIcon
              class="icon-size"
              :icon="['fab', 'x-twitter']"
            />
          </i>
        </a>
      </li>
      <li>
        <AtomIconLink
          aria-label="GitHubに遷移する"
          href="https://github.com/Souta-Kobayashi"
          mdi-icon="mdi-github"
        />
      </li>
    </ul>
  </div>
</template>

<script setup>
import AtomIconLink from "../../atoms/icon/AtomIconLink.vue";
</script>

<style lang="scss" scoped>
.icon-size {
  font-size: 28px;
}
</style>
