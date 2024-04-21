<template>
  <v-dialog
    v-model="showDialogEditLocal"
    max-width="500"
    @update:model-value="$emit('hideDialog')"
  >
    <v-form v-model="isPassed" @submit.prevent>
      <v-card>
        <v-card-title class="text-center"
          >カテゴリ名を変更</v-card-title
        >

        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <AtomCategoryNameEditInput
                  v-model:edit-category-name="
                    editCategoryName
                  "
                  :category-update-error-data="
                    categoryUpdateErrorData
                  "
                />
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <AtomCancelTextButton
            @click="$emit('hideDialog')"
          />
          <AtomUpdateTextButton
            :is-passed="isPassed"
            @click="
              $emit('updateCategory', editCategoryName)
            "
          />
        </v-card-actions>
      </v-card>
    </v-form>
  </v-dialog>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import AtomCancelTextButton from "../atoms/button/AtomCancelTextButton.vue";
import AtomCategoryNameEditInput from "../atoms/input/AtomCategoryNameEditInput.vue";
import AtomUpdateTextButton from "../atoms/button/AtomUpdateTextButton.vue";

const props = defineProps({
  isDialogEdit: {
    type: Boolean,
    default: false,
  },
  editCategoryName: {
    type: String,
    default: "",
  },
  categoryUpdateErrorData: {
    type: Object,
    default: null,
  },
});
const emits = defineEmits([
  "hideDialog",
  "updateCategory",
  "update:editCategoryName",
]);

const editCategoryName = computed({
  get: () => props.editCategoryName,
  set: newValue =>
    emits("update:editCategoryName", newValue),
});
const isPassed = ref(false);
const showDialogEditLocal = ref(false);

watch(
  () => props.isDialogEdit,
  v => {
    showDialogEditLocal.value = v;
  }
);
</script>
