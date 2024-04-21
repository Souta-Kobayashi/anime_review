<template>
  <v-text-field
    v-model="categoryNameLocal.name"
    :error-messages="getErrMessage('name')"
    label="カテゴリ名"
    placeholder="例）学園"
    variant="underlined"
    @blur="blurExecVuelidate('name')"
    @update:model-value="
      e => $emit('update:categoryName', e)
    "
  ></v-text-field>
</template>

<script setup>
import { reactive, watch, onMounted } from "vue";
import { useValidate } from "../../composables/useValidation";

const props = defineProps({
  categoryName: {
    type: String,
    default: "",
  },
  serverErrorMessage: {
    type: Object,
    default: () => ({}),
  },
});
defineEmits(["update:categoryName"]);

// NOTE:
// vuelidateによるバリデーションを行うためpropsを再度リアクティブで宣言かつ、
// v-text-fieldにv-model="categoryNameLocal.name"をセット
// v-model以外(e.g. :value)の値はvuelidateが実行されないため、親子間で2回v-modelを設定している
const categoryNameLocal = reactive({
  name: props.categoryName,
});
const {
  getErrMessage,
  blurExecVuelidate,
  setServerValidationError,
} = useValidate(categoryNameLocal);

onMounted(() => {
  watch(props.serverErrorMessage, newServerErrorMessage => {
    setServerValidationError(newServerErrorMessage);
  });
});
</script>
