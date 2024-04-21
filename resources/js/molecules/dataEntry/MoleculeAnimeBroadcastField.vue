<template>
  <div>
    <div class="broadcast-year">
      <AtomBroadcastYearInput
        @update:broadcast-year="
          e => $emit('update:broadcastYear', e)
        "
      />
    </div>
    <div class="broadcast-season">
      <AtomAnimeSeasonRadioButton
        @update:broadcast-season="
          e => $emit('update:broadcastSeason', e)
        "
      />
    </div>
  </div>
</template>

<script setup>
import AtomBroadcastYearInput from "../../atoms/input/AtomBroadcastYearInput.vue";
import AtomAnimeSeasonRadioButton from "../../atoms/radio/AtomAnimeSeasonRadioButton.vue";

defineProps({
  broadcastYear: {
    type: String,
    default: "",
  },
  broadcastSeason: {
    type: String,
    default: "",
  },
});
defineEmits([
  "update:broadcastYear",
  "update:broadcastSeason",
]);
</script>
