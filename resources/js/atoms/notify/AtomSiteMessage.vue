<template>
  <v-container v-if="visibleSiteMessage">
    <v-alert
      v-model="visibleSiteMessage"
      closable
      density="compact"
      max-width="1400"
      type="info"
      title=""
      text=""
      variant="tonal"
      close-label="Close Alert"
      border="start"
      >本サイトはポートフォリオです。データは定期的にリフレッシュされます
    </v-alert>
  </v-container>
</template>

<script setup>
import { useSiteMessage } from '../../composables/useSiteMessage';

const { visibleSiteMessage } = useSiteMessage();
</script>

<style lang="scss" scoped>
.v-container {
  padding: 1rem 1rem 0 !important;
}
</style>
