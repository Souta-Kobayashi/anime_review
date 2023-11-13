<template>
  <v-col cols="7" sm="7" md="8" lg="9" class="anime-rating">
    <div
      class="d-flex align-items-center justify-content-center mb-4 rating-comprehensive"
    >
      <AtomAnimeRatingComprehensive
        :review-average="reviewAverage"
      />
    </div>

    <div class="d-flex flex-wrap mb-10">
      <MoleculeAnimeRating
        v-for="rating in ratingItems"
        :key="rating.ratingTitle"
        :rating-title="rating.ratingTitle"
        :rating-value="rating.ratingValue"
      />
    </div>

    <AtomRateAnimeTextButton
      @click="showRatingUpdateDialog = true"
    />

    <!-- ダイアログ追加 -->
    <AnimeRatingUpdateDialog
      v-model:show-rating-update-dialog="
        showRatingUpdateDialog
      "
      :rating-items="dialogRatingItems"
      @hide-dialog="hideDialog"
      @save-rating="$emit('saveRating', dialogRatingItems)"
      @dialog-rating-items-update="dialogRatingItemsUpdate"
    />
  </v-col>
</template>

<script setup>
import { ref, watch } from 'vue';
import AnimeRatingUpdateDialog from '../organisms/AnimeRatingUpdateDialog.vue';
import MoleculeAnimeRating from '../molecules/MoleculeAnimeRating.vue';
import AtomAnimeRatingComprehensive from '../atoms/text/AtomAnimeRatingComprehensive.vue';
import AtomRateAnimeTextButton from '../atoms/button/AtomRateAnimeTextButton.vue';

const props = defineProps({
  reviewAverage: {
    type: String,
    default: 'ー',
  },
  reviewStory: {
    type: String,
    default: '0',
  },
  reviewDrawing: {
    type: String,
    default: '0',
  },
  reviewVoiceActor: {
    type: String,
    default: '0',
  },
  reviewMusic: {
    type: String,
    default: '0',
  },
  reviewCharacters: {
    type: String,
    default: '0',
  },
  closeDialog: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits(['saveRating']);

const showRatingUpdateDialog = ref(false);
const ratingItemsMaster = [
  {
    ratingName: 'reviewStory',
    ratingTitle: 'ストーリー',
    ratingValue: props.reviewStory,
  },
  {
    ratingName: 'reviewDrawing',
    ratingTitle: '作画',
    ratingValue: props.reviewDrawing,
  },
  {
    ratingName: 'reviewVoiceActor',
    ratingTitle: '声優',
    ratingValue: props.reviewVoiceActor,
  },
  {
    ratingName: 'reviewMusic',
    ratingTitle: '音楽',
    ratingValue: props.reviewMusic,
  },
  {
    ratingName: 'reviewCharacters',
    ratingTitle: 'キャラクター',
    ratingValue: props.reviewCharacters,
  },
];

// NOTE: オブジェクトは参照渡しのため
// ratingValue: String(...) と宣言しないと新たなメモリが確保されない。
// ratingItems, dialogRatingItemsを独立した値で宣言するための記載
const ratingItems = ref(
  ratingItemsMaster.map(item => ({
    ...item,
    ratingValue: String(item.ratingValue),
  }))
);
const dialogRatingItems = ref(
  ratingItemsMaster.map(item => ({
    ...item,
    ratingValue: String(item.ratingValue),
  }))
);

// APIから取得したratingValueの更新処理
ratingItemsMaster.forEach((item, index) => {
  watch(
    () => props[item.ratingName],
    v => {
      ratingItemsMaster[index].ratingValue = v;
      dialogRatingItems.value[index].ratingValue = v;
      ratingItems.value[index].ratingValue = v;
    }
  );
});

// ダイアログ内ratingの変更処理
const dialogRatingItemsUpdate = (index, v) => {
  dialogRatingItems.value[index].ratingValue = String(v);
};

const hideDialog = () => {
  showRatingUpdateDialog.value = false;

  // NOTE: ダイアログが消える前にpropsの更新処理が走りratingの値が
  // 更新前の状態にリセットされてからダイアログが閉じる状態になりUXを損ねる。
  // vuetifyのv-dialogはtransitionが効いており閉じるまでに時間を要するため。
  // nextTickやasync/awaitでは改善しなかったため、暫定対応としてsetTimeout()でpropsの更新処理を遅らせて対応。
  // AnimeRatingUpdateDialogコンポーネント内の、showRatingUpdateDialogをwatchしてpropsの値を変えればいけそう
  setTimeout(() => {
    dialogRatingItems.value = ratingItemsMaster.map(
      item => ({
        ...item,
        ratingValue: String(item.ratingValue),
      })
    );
  }, 500);
};

// レーティング更新完了後ダイアログを閉じる
watch(
  () => props.closeDialog,
  closeDialog => {
    showRatingUpdateDialog.value = closeDialog
      ? false
      : true;
  }
);
</script>