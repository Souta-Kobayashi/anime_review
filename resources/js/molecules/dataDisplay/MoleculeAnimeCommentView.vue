<template>
  <div>
    <dt
      class="anime-info-list-term d-flex justify-content-between"
    >
      <span>コメント</span>
      <span
        v-if="isLoginStatus && !isEditorVisible"
        class="cursor-pointer"
        @click="
          $emit('editorVisibleToggle', 'comment', true)
        "
      >
        <AtomPencilIcon />
      </span>
    </dt>
    <dd v-if="!isEditorVisible" class="anime-info-text">
      {{ comment !== "" ? comment : "未入力" }}
    </dd>
    <dd v-else>
      <v-textarea
        v-model="commentLocal"
        class="anime-info-text"
        variant="outlined"
        auto-grow
      ></v-textarea>
      <MoleculeUpdateAndCancelButton
        :loading="isLoading"
        @update-anime-info="
          $emit('updateAnimeInfo', 'comment', commentLocal)
        "
        @close-editor="
          $emit('editorVisibleToggle', 'comment', false)
        "
      />
    </dd>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import AtomPencilIcon from "../../atoms/icon/AtomPencilIcon.vue";
import MoleculeUpdateAndCancelButton from "../buttonGroup/MoleculeUpdateAndCancelButton.vue";

const props = defineProps({
  comment: {
    type: String,
    default: "",
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

const commentLocal = ref(props.comment);

watch(
  () => props.comment,
  v => {
    commentLocal.value = v;
  }
);
</script>
