<template>
  <v-text-field
    v-model="animeNameLocal.name"
    :error-messages="getErrMessage('name')"
    label="アニメ名"
    placeholder="例）呪術廻戦"
    variant="underlined"
    @blur="blurExecVuelidate('name')"
    @update:modelValue="e => $emit('update:animeName', e)"
  ></v-text-field>
</template>

<script setup>
import { reactive, watch, onMounted } from 'vue';
import { useValidate } from '../../composables/useValidation';

const props = defineProps({
  animeName: {
    type: String,
    default: '',
  },
  serverErrorMessage: {
    type: Object,
    default: {},
  },
});
const emit = defineEmits(['update:animeName']);

// NOTE:
// vuelidateによるバリデーションを行うためpropsを再度リアクティブで宣言かつ、
// v-text-fieldにv-model="animeNameLocal.name"をセット
// v-model以外(e.g. :value)の値はvuelidateが実行されないため、親子間で2回v-modelを設定している
const animeNameLocal = reactive({
  name: props.animeName,
});
const {
  getErrMessage,
  blurExecVuelidate,
  setServerValidationError,
} = useValidate(animeNameLocal);

onMounted(() => {
  watch(props.serverErrorMessage, newServerErrorMessage => {
    setServerValidationError(newServerErrorMessage);
  });
});
</script>
