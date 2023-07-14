<template>
  <main role="main">
    <div class="container">
      <form>
        <!-- アニメ名 -->
        <AnimeNameField />

        <!-- 放送時期 -->
        <BroadcastTimeField
          :toggle-broadcast-time="toggleContents.broadcastTime"
        />

        <!-- ジャンル -->
        <GenreField
          :toggle-genre="toggleContents.genre"
        />

        <!-- あらすじ -->
        <SynopsisField
          :toggle-synopsis="toggleContents.synopsis"
        />

        <!-- キービジュアル -->
        <KeyVisualField
          :toggle-key-visual="toggleContents.keyVisual"
        />

        <!-- キービジュアル引用元 -->
        <KeyVisualSourceField
          :toggle-key-visual-source="toggleContents.keyVisualSource"
        />

        <button type="submit" class="btn btn-primary">アニメ登録</button>
      </form>
    </div>
  </main>
</template>

<script setup>
import { ref } from 'vue';
import AnimeNameField from '../components/AnimeCreateFormAnimeNameField.vue';
import BroadcastTimeField from '../components/AnimeCreateFormBroadcastTimeField.vue';
import GenreField from '../components/AnimeCreateFormGenreField.vue';
import SynopsisField from '../components/AnimeCreateFormSynopsisField.vue';
import KeyVisualField from '../components/AnimeCreateFormKeyVisualField.vue';
import KeyVisualSourceField from '../components/AnimeCreateFormKeyVisualSourceField.vue';

const toggleContents = ref({
  broadcastTime: false,
  genre: false,
  synopsis: false,
  keyVisual: false,
  keyVisualSource: false,
});
</script>