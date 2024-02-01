<template>
  <v-dialog width="auto">
    <v-card>
      <v-card-text
        >このページから移動しても良いですか？作業途中のデータは保存されません。
      </v-card-text>
      <v-card-actions class="justify-content-center">
        <AtomBackTextButton @click="$emit('goNextPage')" />
        <AtomCancelTextButton
          @click="$emit('hideNavigationConfirmDialog')"
          color="deep-orange-darken-4"
        />
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import AtomBackTextButton from '../atoms/button/AtomLeavePageTextButton.vue';
import AtomCancelTextButton from '../atoms/button/AtomCancelTextButton.vue';

const emit = defineEmits([
  'goNextPage',
  'hideNavigationConfirmDialog',
]);
</script>
