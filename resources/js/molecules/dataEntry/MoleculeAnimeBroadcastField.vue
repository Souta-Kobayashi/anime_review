<template>
  <div>
    <div class="broadcast-year">
      <AtomBroadcastYearInput
        @update:broadcastYear="
          e => $emit('update:broadcastYear', e)
        "
      />
    </div>
    <div class="broadcast-season">
      <AtomAnimeSeasonRadioButton
        @update:broadcastSeason="
          e => $emit('update:broadcastSeason', e)
        "
      />
    </div>
  </div>
</template>

<script setup>
import AtomBroadcastYearInput from '../../atoms/input/AtomBroadcastYearInput.vue';
import AtomAnimeSeasonRadioButton from '../../atoms/radio/AtomAnimeSeasonRadioButton.vue';

const props = defineProps({
  broadcastYear: {
    type: String,
    default: '',
  },
  broadcastSeason: {
    type: String,
    default: '',
  },
});
const emit = defineEmits([
  'update:broadcastYear',
  'update:broadcastSeason',
]);
</script>
