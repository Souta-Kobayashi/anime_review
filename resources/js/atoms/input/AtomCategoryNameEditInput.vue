<template>
  <v-text-field
    v-model="editCategoryNameLocal.name"
    :error-messages="categoryNameErrorMessage"
    label="カテゴリ名"
    @blur="blurExecVuelidate('name')"
    @update:modelValue="
      e => $emit('update:editCategoryName', e)
    "
  ></v-text-field>
</template>

<script setup>
import { reactive, watch, computed } from 'vue';
import { useValidate } from '../../composables/useValidation';

const props = defineProps({
  editCategoryName: {
    type: String,
    default: '',
  },
  categoryUpdateErrorData: {
    type: Object,
    default: null,
  },
});
const emit = defineEmits(['update:editCategoryName']);

const editCategoryNameLocal = reactive({
  name: props.editCategoryName,
});
const {
  getErrMessage,
  blurExecVuelidate,
  setServerValidationError,
} = useValidate(editCategoryNameLocal);

const categoryNameErrorMessage = computed(() =>
  getErrMessage('name')
);

watch(
  () => props.categoryUpdateErrorData,
  () => {
    setServerValidationError(props.categoryUpdateErrorData);
  }
);
</script>
