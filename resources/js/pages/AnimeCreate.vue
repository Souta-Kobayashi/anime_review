<template>
  <BaseHeader />
  <main>
    <v-sheet class="pa-6 mx-auto" max-width="1000px">
      <h4 class="text-center">アニメ登録</h4>
      <v-form
        v-model="isPassed"
        @submit.prevent
        @input="setFormDirty(true)"
      >
        <v-container>
          <AtomAnimeNameInput
            v-model:anime-name="form.animeName"
            :error-messages="nameErrorMessage"
            @blur="blurExecVuelidate('animeName')"
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
            :error-messages="synopsisErrorMessage"
            @blur="blurExecVuelidate('synopsis')"
          />
          <MoleculeAnimeKeyVisualField
            v-model:key-visual-image="form.keyVisualImage"
            v-model:key-visual-reference="
              form.keyVisualReference
            "
            :image-err-message="imageErrorMessage"
            :reference-err-message="referenceErrorMessage"
            @blur-image="
              blurExecVuelidate('keyVisualImage')
            "
            @blur-reference="
              blurExecVuelidate('keyVisualReference')
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
import { ref, reactive, computed } from 'vue';
import router from '../router';
import { useApiRequest } from '../composables/useApiRequest';
import { useValidate } from '../composables/useValidation';
import { useHelpers } from '../composables/useHelpers';
import { useVueRouterBeforeRouteLeave } from '../composables/useVueRouterBeforeRouteLeave';
import AtomSnackbar from '../atoms/notify/AtomSnackbar.vue';
import AtomAnimeNameInput from '../atoms/input/AtomAnimeNameInput.vue';
import AtomAnimeGenreRadioButton from '../atoms/radio/AtomAnimeGenreRadioButton.vue';
import AtomAnimeSynopsisTextarea from '../atoms/textarea/AtomAnimeSynopsisTextarea.vue';
import AtomAnimeCreateSubmitButton from '../atoms/button/AtomAnimeCreateSubmitButton.vue';
import MoleculeAnimeBroadcastField from '../molecules/dataEntry/MoleculeAnimeBroadcastField.vue';
import MoleculeAnimeKeyVisualField from '../molecules/dataEntry/MoleculeAnimeKeyVisualField.vue';

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
const helpers = useHelpers();
const {
  getErrMessage,
  blurExecVuelidate,
  setServerValidationError,
} = useValidate(form);
const { setFormDirty } = useVueRouterBeforeRouteLeave(); // 入力途中でページ遷移時ダイアログを表示

// エラーメッセージ
const nameErrorMessage = computed(() =>
  getErrMessage('animeName')
);
const synopsisErrorMessage = computed(() =>
  getErrMessage('synopsis')
);
const imageErrorMessage = computed(() =>
  getErrMessage('keyVisualImage')
);
const referenceErrorMessage = computed(() =>
  getErrMessage('keyVisualReference')
);

// apiリクエストするフォーム作成
const makeRequestFormData = () => {
  const formData = new FormData();
  const broadcastYear = form.broadcastYear ?? '';
  let keyVisualImage;

  formData.append('name', form.animeName);
  formData.append(
    'broadcast_date',
    `${broadcastYear},${form.broadcastSeason}`
  );
  formData.append('genre', form.genre);
  formData.append('synopsis', form.synopsis);

  if (form.keyVisualImage[0]) {
    keyVisualImage = form.keyVisualImage[0];
  } else {
    keyVisualImage = '';
  }
  formData.append('key_visual_image', keyVisualImage);
  formData.append(
    'key_visual_reference',
    form.keyVisualReference
  );

  return formData;
};

// アニメ登録
const submitAnimeRegister = async () => {
  setLoading(true);

  const formData = makeRequestFormData();
  const result = await apiPostRequest(
    '/api/anime/create',
    formData,
    {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    }
  );

  if (result.status === 201) {
    setFormDirty(false);
    router.push({ name: 'home' });
  } else if (result.status === 422) {
    // prettier-ignore
    const convertServerData = function (key) {
      if (key === 'name')                 return 'animeName';
      if (key === 'key_visual_image')     return helpers.toCamelCase(key);
      if (key === 'key_visual_reference') return helpers.toCamelCase(key);
      return key;
    };
    // サーバーエラーメッセージを生成
    for (const serverKey in result.data.errors) {
      const key = convertServerData(serverKey);
      serverErrorMessage[key] =
        result.data.errors[serverKey];
    }
    setServerValidationError(serverErrorMessage);
  }
  setLoading(false);
};
</script>
