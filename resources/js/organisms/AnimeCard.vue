<template>
  <v-row align="start">
    <v-col
      v-for="anime in displayAnimeList"
      :key="anime.id"
      cols="12"
      sm="6"
      lg="4"
      class="anime-card-wrapper"
      @mouseover="displayOverlayOnPc(anime.id)"
      @mouseleave="hideOverlayOnPc()"
    >
      <RouterLink :to="`/anime/${anime.id}`">
        <v-card
          class="anime-card"
          color="#0d3b3a"
          theme="dark"
          max-height="350"
        >
          <div
            class="d-flex flex-no-wrap justify-space-between"
          >
            <AtomAnimeCardImage
              :src="anime.keyVisual"
              :key-visual-reference="
                anime.keyVisualReference
              "
            />
            <MoleculeAnimeCardDescription
              :anime-name="anime.animeName"
              :category="anime.category"
              :rating="anime.rating"
              :synopsis="anime.synopsis"
            />
          </div>
          <v-overlay
            class="align-center justify-center"
            scrim="#0e182a"
            contained
            :model-value="hoveredCard === anime.id"
          >
            <v-btn variant="flat">アニメ詳細を見る</v-btn>
          </v-overlay>
        </v-card>
      </RouterLink>
    </v-col>
  </v-row>
</template>

<script setup>
import { ref } from 'vue';
import AtomAnimeCardImage from '../atoms/image/AtomAnimeCardImage.vue';
import MoleculeAnimeCardDescription from '../molecules/MoleculeAnimeCardDescription.vue';

const props = defineProps({
  displayAnimeList: {
    type: Array,
    default: [],
  },
});

// NOTE: vuetifyのv-hoverではスマホでタップ時にもhoverの判定となってしまう
// オーバーレイはPC時のみ表示したいため関数を用意
// v-hoverのドキュメント(https://vuetifyjs.com/en/components/hover/)
const hoveredCard = ref(null);
const displayOverlayOnPc = animeId => {
  hoveredCard.value = animeId;
};
const hideOverlayOnPc = () => {
  hoveredCard.value = null;
};
</script>
