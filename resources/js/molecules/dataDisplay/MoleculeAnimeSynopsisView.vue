<template>
  <div>
    <dt
      class="anime-info-list-term d-flex justify-content-between"
    >
      <span>あらすじ</span>
      <span
        v-if="isLoginStatus && !isEditorVisible"
        class="cursor-pointer"
        @click="
          $emit('editorVisibleToggle', 'synopsis', true)
        "
      >
        <AtomPencilIcon />
      </span>
    </dt>
    <dd v-if="!isEditorVisible" class="anime-info-text">
      {{ synopsis }}
    </dd>
    <dd v-else="isEditorVisible">
      <v-textarea
        v-model="synopsisLocal"
        class="anime-info-text"
        variant="outlined"
        auto-grow
      ></v-textarea>
      <MoleculeUpdateAndCancelButton
        :loading="isLoading"
        @update-anime-info="
          $emit(
            'updateAnimeInfo',
            'synopsis',
            synopsisLocal
          )
        "
        @close-editor="
          $emit('editorVisibleToggle', 'synopsis', false)
        "
      />
    </dd>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import AtomPencilIcon from '../../atoms/icon/AtomPencilIcon.vue';
import MoleculeUpdateAndCancelButton from '../buttonGroup/MoleculeUpdateAndCancelButton.vue';

const props = defineProps({
  synopsis: {
    type: String,
    default: '',
  },
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
  isEditorVisible: {
    type: Boolean,
    default: false,
  },
  isLoading: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits([
  'updateAnimeInfo',
  'editorVisibleToggle',
]);

const synopsisLocal = ref(props.synopsis);

watch(
  () => props.synopsis,
  v => {
    synopsisLocal.value = v;
  }
);
</script>
