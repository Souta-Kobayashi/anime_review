<template>
  <v-hover v-slot="{ isHovering, props }">
    <v-col
      cols="12"
      sm="6"
      lg="4"
      class="anime-card-wrapper"
    >
      <v-card
        v-bind="props"
        class="anime-card"
        color="#0d3b3a"
        theme="dark"
        max-height="350"
      >
        <div
          class="d-flex flex-no-wrap justify-space-between"
        >
          <AtomAnimeCardImage
            :src="keyVisual"
            :key-visual-reference="keyVisualReference"
          />
          <MoleculeAnimeCardDescription
            :anime-name="animeName"
            :category="category"
            :rating="rating"
            :synopsis="synopsis"
          />
        </div>
        <v-overlay
          class="align-center justify-center"
          scrim="#0e182a"
          contained
          :model-value="isHovering"
          @click="router.push({ path: `/anime/${id}` })"
        >
          <v-btn variant="flat">アニメ詳細を見る</v-btn>
        </v-overlay>
      </v-card>
    </v-col>
  </v-hover>
</template>

<script setup>
import router from '../router';
import AtomAnimeCardImage from '../atoms/image/AtomAnimeCardImage.vue';
import MoleculeAnimeCardDescription from '../molecules/MoleculeAnimeCardDescription.vue';

const props = defineProps({
  id: {
    type: Number,
    default: null,
  },
  animeName: {
    type: String,
    default: '',
  },
  category: {
    type: String,
    default: '',
  },
  rating: {
    type: String,
    default: '',
  },
  synopsis: {
    type: String,
    default: '',
  },
  keyVisual: {
    type: String,
    default: '',
  },
  keyVisualReference: {
    type: String,
    default: '',
  },
});
</script>
