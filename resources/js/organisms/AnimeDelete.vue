<template>
  <v-btn
    class="ma-2"
    color="brown-lighten-2"
    icon="mdi-trash-can-outline"
    size="small"
    @delete-anime="$emit('deleteAnime')"
    @click="showDialog"
  ></v-btn>

  <v-dialog
    v-model="isDestroyDialogVisible"
    max-width="500"
  >
    <v-card>
      <p class="text-center fs-5 py-2 px-4">
        「{{ animeName }}」を削除しますか？
      </p>
      <v-card-actions>
        <v-spacer></v-spacer>
        <AtomCancelTextButton
          @click="isDestroyDialogVisible = false"
        />
        <AtomDeleteTextButton
          @click="$emit('destroyAnime')"
        />
        <v-spacer></v-spacer>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, watch } from 'vue';
import AtomCancelTextButton from '../atoms/button/AtomCancelTextButton.vue';
import AtomDeleteTextButton from '../atoms/button/AtomDeleteTextButton.vue';

const props = defineProps({
  animeName: {
    type: String,
    default: '',
  },
});
const emit = defineEmits(['destroyAnime']);

const isDestroyDialogVisible = ref(false);
const showDialog = () => {
  isDestroyDialogVisible.value = true;
};
</script>
