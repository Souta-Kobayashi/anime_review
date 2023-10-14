<template>
  <AtomAnimeKeyVisualImageInput
    @update:keyVisualImage="
      e => $emit('update:keyVisualImage', e)
    "
  />
  <AtomAnimeKeyVisualSourceInput
    @update:keyVisualReference="
      e => $emit('update:keyVisualReference', e)
    "
  />
</template>

<script setup>
import AtomAnimeKeyVisualSourceInput from '../atoms/input/AtomAnimeKeyVisualSourceInput.vue';
import AtomAnimeKeyVisualImageInput from '../atoms/input/AtomAnimeKeyVisualImageInput.vue';

const props = defineProps({
  // NOTE: 親のv-modelで渡された変数を受け取る。
  // keyVisualImageはファイルとなるため使用しないがvueのwarnを出さないための記載
  keyVisualImage: null,
  keyVisualReference: {
    type: String,
    default: '',
  },
});
const emit = defineEmits([
  'update:keyVisualImage',
  'update:keyVisualReference',
]);
</script>
