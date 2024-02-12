<template>
  <v-container
    class="position-relative d-flex"
    v-if="isFetching"
  >
    <v-row align="start">
      <v-col
        v-for="index in animeCardCount"
        :key="index"
        cols="12"
        sm="6"
        lg="4"
      >
        <div
          class="d-flex justify-space-between card-skeleton-loader"
        >
          <v-skeleton-loader
            class="w-50"
            type="image"
          ></v-skeleton-loader>
          <div class="w-50">
            <v-skeleton-loader
              type="heading, actions, paragraph, list-item-two-line, paragraph"
            ></v-skeleton-loader>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
const props = defineProps({
  isFetching: {
    type: Boolean,
    default: true,
  },
  animeCardCount: {
    type: Number,
    default: 5,
  },
});
</script>

<style lang="scss" scoped>
.card-skeleton-loader {
  max-height: 350px;
}
</style>
