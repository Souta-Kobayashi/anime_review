<template>
  <v-text-field
    v-model="editCategoryName.name"
    :error-messages="categoryNameErrorMessage"
    label="カテゴリ名"
    @blur="blurExecVuelidate('name')"
    @update:model-value="
      e => $emit('update:editCategoryName', e)
    "
  ></v-text-field>
</template>

<script setup>
import { reactive, watch, computed } from "vue";
import { useValidate } from "../../composables/useValidation";

const props = defineProps({
  editCategoryName: {
    type: String,
    default: "",
  },
  categoryUpdateErrorData: {
    type: Object,
    default: null,
  },
});
defineEmits(["update:editCategoryName"]);

const editCategoryName = reactive({
  name: props.editCategoryName,
});
const {
  getErrMessage,
  blurExecVuelidate,
  setServerValidationError,
} = useValidate(editCategoryName);

const categoryNameErrorMessage = computed(() =>
  getErrMessage("name")
);

watch(
  () => props.categoryUpdateErrorData,
  () => {
    setServerValidationError(props.categoryUpdateErrorData);
  }
);
</script>
