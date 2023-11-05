<template>
  <v-dialog
    v-model="showRatingUpdateDialogLocal"
    max-width="700"
  >
    <v-form @submit.prevent>
      <v-card>
        <v-card-title class="text-center"
          >アニメを評価する</v-card-title
        >

        <v-container class="anime-rating">
          <div
            class="position-relative rating-item"
            v-for="(rating, index) in ratingItemsLocal"
            :key="rating.ratingTitle"
          >
            <span class="rating-title"
              >{{ rating.ratingTitle }}：</span
            >
            <AtomRating
              :rating="rating.ratingValue"
              :readonly="false"
              size="35"
              clearable
              @update:rating="
                v =>
                  $emit('dialogRatingItemsUpdate', index, v)
              "
            />
          </div>
        </v-container>

        <v-card-actions>
          <v-spacer></v-spacer>
          <AtomCancelTextButton
            @click="$emit('hideDialog')"
          />
          <AtomUpdateTextButton
            isPassed
            @click="$emit('saveRating')"
          />
        </v-card-actions>
      </v-card>
    </v-form>
  </v-dialog>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import AtomRating from '../atoms/rating/AtomRating.vue';
import AtomCancelTextButton from '../atoms/button/AtomCancelTextButton.vue';
import AtomUpdateTextButton from '../atoms/button/AtomUpdateTextButton.vue';

const props = defineProps({
  showRatingUpdateDialog: {
    type: Boolean,
    default: false,
  },
  ratingItems: {
    type: Array,
    default: [],
  },
});
const emit = defineEmits([
  'hideDialog',
  'update:showRatingUpdateDialog',
  'dialogRatingItemsUpdate',
  'saveRating', // レーティングのAPIリクエスト
]);

const showRatingUpdateDialogLocal = computed({
  get() {
    return props.showRatingUpdateDialog;
  },
  set(v) {
    emit('update:showRatingUpdateDialog', v);
  },
});

const ratingItemsLocal = ref({ ...props.ratingItems });
watch(
  () => props.ratingItems,
  v => {
    ratingItemsLocal.value = v;
  }
);
</script>
