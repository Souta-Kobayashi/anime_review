<template>
  <v-dialog max-width="500">
    <v-card>
      <v-card-text class="text-center"
        >ログアウトしてもよろしいですか？</v-card-text
      >
      <v-card-actions class="justify-content-center">
        <AtomCancelTextButton
          @click="$emit('closeDialog')"
        />
        <AtomOkTextButton @click="$emit('userLogout')" />
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import AtomCancelTextButton from '../atoms/button/AtomCancelTextButton.vue';
import AtomOkTextButton from '../atoms/button/AtomOkTextButton.vue';

defineEmits(['closeDialog', 'userLogout']);
</script>
