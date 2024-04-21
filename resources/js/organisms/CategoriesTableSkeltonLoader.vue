<template>
  <template v-if="isFetching">
    <tr>
      <td>
        <v-skeleton-loader
          type="table-heading"
        ></v-skeleton-loader>
      </td>
    </tr>

    <tr v-for="index in categoryTableRowCount" :key="index">
      <td>
        <v-skeleton-loader
          type="text,divider"
        ></v-skeleton-loader>
      </td>
    </tr>
  </template>
</template>

<script setup>
defineProps({
  isFetching: {
    type: Boolean,
    default: true,
  },
  categoryTableRowCount: {
    type: Number,
    default: 20,
  },
});
</script>
