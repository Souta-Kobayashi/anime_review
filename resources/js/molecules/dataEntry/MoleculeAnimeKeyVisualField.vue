<template>
  <AtomAnimeKeyVisualImageInput
    :error-messages="imageErrMessage"
    @update:key-visual-image="
      e => $emit('update:keyVisualImage', e)
    "
    @mousedown:control="$emit('blurImage')"
  />
  <AtomAnimeKeyVisualSourceInput
    :error-messages="referenceErrMessage"
    @update:key-visual-reference="
      e => $emit('update:keyVisualReference', e)
    "
    @blur="$emit('blurReference')"
  />
</template>

<script setup>
import AtomAnimeKeyVisualSourceInput from "../../atoms/input/AtomAnimeKeyVisualSourceInput.vue";
import AtomAnimeKeyVisualImageInput from "../../atoms/input/AtomAnimeKeyVisualImageInput.vue";

defineProps({
  // NOTE: 親のv-modelで渡された変数を受け取る。
  // keyVisualImageはファイルとなるため使用しないがvueのwarnを出さないための記載
  keyVisualImage: {
    type: Array,
    default: null,
  },
  keyVisualReference: {
    type: String,
    default: "",
  },
  imageErrMessage: {
    type: String,
    default: "",
  },
  referenceErrMessage: {
    type: String,
    default: "",
  },
});
defineEmits([
  "update:keyVisualImage",
  "update:keyVisualReference",
  "blurImage",
  "blurReference",
]);
</script>
