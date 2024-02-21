<template>
  <v-container v-if="visibleSiteMessage">
    <v-alert
      v-model="visibleSiteMessage"
      closable
      density="compact"
      type="info"
      variant="tonal"
      close-label="Close Alert"
      border="start"
      >本サイトはポートフォリオです。データは定期的にリフレッシュされます
    </v-alert>
  </v-container>
  <div v-else class="main-margin-top"></div>
</template>

<script setup>
import { useSiteMessage } from '../../composables/useSiteMessage';

const { visibleSiteMessage } = useSiteMessage();
</script>

<style lang="scss" scoped>
.v-container {
  margin-top: 60px;
  padding: 1rem 1rem 0 !important;
}
.main-margin-top {
  margin-top: 60px;
}
</style>
