<template>
  <div>
    <dt
      class="anime-info-list-term d-flex justify-content-between"
    >
      <span>放送時期</span>
      <span
        v-if="isLoginStatus && !isEditorVisible"
        class="cursor-pointer"
        @click="
          $emit(
            'editorVisibleToggle',
            'broadcastDate',
            true
          )
        "
      >
        <AtomPencilIcon />
      </span>
    </dt>
    <dd v-if="!isEditorVisible" class="anime-info-text">
      {{ broadcastDate !== "" ? broadcastDate : "未選択" }}
    </dd>
    <dd v-else>
      <div>
        <AtomBroadcastYearInput
          v-model="year"
          class="anime-info-text broadcast-year"
        />
        <AtomAnimeSeasonRadioButton
          v-model="season"
          class="px-3"
        />
      </div>
      <MoleculeUpdateAndCancelButton
        :loading="isLoading"
        @update-anime-info="
          $emit('updateAnimeInfo', 'broadcast_date', {
            year,
            season,
          })
        "
        @close-editor="
          $emit(
            'editorVisibleToggle',
            'broadcastDate',
            false
          )
        "
      />
    </dd>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import AtomPencilIcon from "../../atoms/icon/AtomPencilIcon.vue";
import AtomBroadcastYearInput from "../../atoms/input/AtomBroadcastYearInput.vue";
import AtomAnimeSeasonRadioButton from "../../atoms/radio/AtomAnimeSeasonRadioButton.vue";
import MoleculeUpdateAndCancelButton from "../buttonGroup/MoleculeUpdateAndCancelButton.vue";

const props = defineProps({
  broadcastDate: {
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

const year = ref("");
const season = ref("");

const extractValues = () => {
  if (props.broadcastDate) {
    const yearMatch = props.broadcastDate.match(/\d{4}年/);
    year.value = yearMatch ? yearMatch[0] : "";

    const seasonMatch = props.broadcastDate.match(
      /秋アニメ|冬アニメ|春アニメ|夏アニメ/
    );
    season.value = seasonMatch ? seasonMatch[0] : "";
  }
};

watch(() => props.broadcastDate, extractValues, {
  immediate: true,
});
</script>
