<template>
  <v-dialog
    v-model="isDestroyDialogVisibleLocal"
    max-width="500"
    @update:model-value="$emit('hideDialog')"
  >
    <v-card>
      <p class="text-center fs-5 py-2 px-4">
        「{{ selectCategoryName }}」を削除しますか？
      </p>
      <v-card-actions>
        <v-spacer></v-spacer>
        <AtomCancelTextButton
          @click="$emit('hideDialog')"
        />
        <AtomDeleteTextButton
          @click="$emit('destroyCategory')"
        />
        <v-spacer></v-spacer>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, watch } from "vue";
import AtomCancelTextButton from "../atoms/button/AtomCancelTextButton.vue";
import AtomDeleteTextButton from "../atoms/button/AtomDeleteTextButton.vue";

const props = defineProps({
  isDestroyDialogVisible: {
    type: Boolean,
    default: false,
  },
  selectCategoryName: {
    type: String,
    default: "",
  },
});
defineEmits(["hideDialog", "destroyCategory"]);

const isDestroyDialogVisibleLocal = ref(false);

watch(
  () => props.isDestroyDialogVisible,
  v => {
    isDestroyDialogVisibleLocal.value = v;
  }
);
</script>
