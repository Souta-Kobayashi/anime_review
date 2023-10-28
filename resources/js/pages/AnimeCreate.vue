<template>
  <BaseHeader />
  <main>
    <v-sheet class="pa-6 mx-auto" max-width="1000px">
      <h4 class="text-center">アニメ登録</h4>
      <v-form v-model="isPassed" @submit.prevent>
        <v-container>
          <AtomAnimeNameInput
            v-model:anime-name="form.animeName"
            :server-error-message="serverErrorMessage"
          />
          <MoleculeAnimeBroadcastField
            v-model:broadcastYear="form.broadcastYear"
            v-model:broadcast-season="form.broadcastSeason"
          />
          <AtomAnimeGenreRadioButton
            v-model:genre="form.genre"
          />
          <AtomAnimeSynopsisTextarea
            v-model:synopsis="form.synopsis"
          />
          <MoleculeAnimeKeyVisualField
            v-model:key-visual-image="form.keyVisualImage"
            v-model:key-visual-reference="
              form.keyVisualReference
            "
          />
          <AtomAnimeCreateSubmitButton
            :isPassed="isPassed"
            :loading="loading"
            @submit-anime-register="submitAnimeRegister"
          />
        </v-container>
      </v-form>
    </v-sheet>
  </main>
  <BaseFooter />
  <AtomSnackbar />
</template>

<script setup>
import { ref, reactive } from 'vue';
import router from '../router';
import { useApiRequest } from '../composables/useApiRequest';
import AtomSnackbar from '../atoms/AtomSnackbar.vue';
import AtomAnimeNameInput from '../atoms/input/AtomAnimeNameInput.vue';
import AtomAnimeGenreRadioButton from '../atoms/radio/AtomAnimeGenreRadioButton.vue';
import AtomAnimeSynopsisTextarea from '../atoms/textarea/AtomAnimeSynopsisTextarea.vue';
import AtomAnimeCreateSubmitButton from '../atoms/button/AtomAnimeCreateSubmitButton.vue';
import MoleculeAnimeBroadcastField from '../molecules/MoleculeAnimeBroadcastField.vue';
import MoleculeAnimeKeyVisualField from '../molecules/MoleculeAnimeKeyVisualField.vue';

const form = reactive({
  animeName: '',
  broadcastYear: '',
  broadcastSeason: '',
  genre: '',
  synopsis: '',
  keyVisualImage: '',
  keyVisualReference: '',
});
const isPassed = ref(false);
const serverErrorMessage = reactive({});
// composables
const { loading, setLoading, apiPostRequest } =
  useApiRequest();

const submitAnimeRegister = async () => {
  setLoading(true);
  const formData = new FormData();
  formData.append('animeName', form.animeName);
  const broadcastYear = form.broadcastYear ?? '';
  formData.append(
    'broadcast_date',
    `${broadcastYear},${form.broadcastSeason}`
  );
  formData.append('genre', form.genre);
  formData.append('synopsis', form.synopsis);
  formData.append('keyVisualImage', form.keyVisualImage[0]);
  formData.append(
    'keyVisualReference',
    form.keyVisualReference
  );

  const result = await apiPostRequest(
    '/api/anime/create',
    formData,
    {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    }
  );
  router.push({ name: 'home' });

  // このフォーマットで通る
  // result.response.data.errors = {
  //   name: ['nameは必ず指定してください。'],
  //   password: ['passwordは必ず指定してください。'],
  // };

  // TODO: バックエンド側実装後修正する
  // サーバー側バリデーションチェックの戻り値からエラーメッセージセット
  // if () {

  // }

  // for (const key in result.data.errors) {
  //   serverErrorMessage[key] = result.data.errors[key];
  // }

  setLoading(false);
};
</script>
