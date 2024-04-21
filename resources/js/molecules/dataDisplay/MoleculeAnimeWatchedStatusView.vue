<template>
  <div>
    <dt
      class="anime-info-list-term d-flex justify-content-between"
    >
      <span>視聴状況</span>
      <span
        v-if="isLoginStatus && !isEditorVisible"
        class="cursor-pointer"
        @click="
          $emit(
            'editorVisibleToggle',
            'watchedStatus',
            true
          )
        "
      >
        <AtomPencilIcon />
      </span>
    </dt>

    <dd v-if="!isEditorVisible" class="anime-info-text">
      {{ watchedStatusName }}
    </dd>
    <dd v-else>
      <MoleculeAnimeWatchedStatusRadioGroup
        v-model="watchedStatusLocal"
        inline
      />
      <MoleculeUpdateAndCancelButton
        :loading="isLoading"
        @update-anime-info="
          $emit(
            'updateAnimeInfo',
            'watched_status',
            watchedStatusLocal
          )
        "
        @close-editor="
          $emit(
            'editorVisibleToggle',
            'watchedStatus',
            false
          )
        "
      />
    </dd>
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import AtomPencilIcon from "../../atoms/icon/AtomPencilIcon.vue";
import MoleculeAnimeWatchedStatusRadioGroup from "../radioGroup/MoleculeAnimeWatchedStatusRadioGroup.vue";
import MoleculeUpdateAndCancelButton from "../buttonGroup/MoleculeUpdateAndCancelButton.vue";

const props = defineProps({
  watchedStatus: {
    type: Number,
    default: null,
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
defineEmits(["updateAnimeInfo", "editorVisibleToggle"]);

const watchedStatusLocal = ref(props.watchedStatus);

watch(
  () => props.watchedStatus,
  v => {
    watchedStatusLocal.value = v;
  }
);

// prettier-ignore
const watchedStatusName = computed(() =>
  props.watchedStatus === 10 ? '未視聴'
  : props.watchedStatus === 20 ? '視聴中'
  : props.watchedStatus === 30 ? '視聴断念'
  : props.watchedStatus === 40 ? '視聴済'
  : '未選択'
);
</script>
