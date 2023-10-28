<template>
  <v-sheet
    class="pa-6 mx-auto"
    max-width="700px"
    width="100vw"
  >
    <h4 class="text-center">ユーザー登録</h4>

    <v-form v-model="isPassed" @submit.prevent>
      <v-container>
        <v-text-field
          v-model="form.name"
          :error-messages="getErrMessage('name')"
          color="primary"
          label="ユーザー名"
          variant="underlined"
          required
          prepend-inner-icon="mdi-account-outline"
          @blur="blurExecVuelidate('name')"
        ></v-text-field>

        <v-text-field
          v-model="form.email"
          :error-messages="getErrMessage('email')"
          color="primary"
          label="メールアドレス"
          prepend-inner-icon="mdi-email-outline"
          variant="underlined"
          autocomplete="username"
          @blur="blurExecVuelidate('email')"
        ></v-text-field>

        <v-text-field
          v-model="form.password"
          :type="showPassword ? 'text' : 'password'"
          :error-messages="getErrMessage('password')"
          :append-inner-icon="
            showPassword ? 'mdi-eye' : 'mdi-eye-off'
          "
          :counter="8"
          color="primary"
          label="パスワード"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="underlined"
          hint="※8文字以上の英数字"
          autocomplete="new-password"
          @click:appendInner="showPassword = !showPassword"
          @blur="blurExecVuelidate('password')"
        ></v-text-field>

        <v-text-field
          v-model="form.password_confirmation"
          :type="
            showConfirmationPassword ? 'text' : 'password'
          "
          :error-messages="
            getErrMessage('password_confirmation')
          "
          :append-inner-icon="
            showConfirmationPassword
              ? 'mdi-eye'
              : 'mdi-eye-off'
          "
          color="primary"
          label="パスワード(確認用)"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="underlined"
          autocomplete="new-password"
          @click:appendInner="
            showConfirmationPassword =
              !showConfirmationPassword
          "
          @blur="blurExecVuelidate('password_confirmation')"
        ></v-text-field>

        <v-checkbox
          color="secondary"
          label="サイト規約に同意します"
        ></v-checkbox>
        <v-btn
          :disabled="!isPassed"
          :loading="loading"
          block
          color="blue-grey"
          size="large"
          type="submit"
          variant="elevated"
          @click="submitRegisterUser"
        >
          登録を完了する
        </v-btn>
      </v-container>
    </v-form>
  </v-sheet>
  <BaseFooter />
  <AtomSnackbar />
</template>

<script setup>
import { ref, reactive } from 'vue';
import router from '../router';
import { useApiRequest } from '../composables/useApiRequest';
import { useValidate } from '../composables/useValidation';
import AtomSnackbar from '../atoms/AtomSnackbar.vue';

// form
const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
});

// composables
const { loading, setLoading, apiPostRequest } =
  useApiRequest();
const {
  getErrMessage,
  blurExecVuelidate,
  setServerValidationError,
} = useValidate(form);

const showPassword = ref(false);
const showConfirmationPassword = ref(false);
const isPassed = ref(false);

// submit
const submitRegisterUser = async () => {
  setLoading(true);
  const result = await apiPostRequest(
    '/api/register',
    form
  );
  if (result.status === 422) {
    const errObject = result.data.errors;
    setServerValidationError(errObject);
  } else if (result.status === 200) {
    router.push({ name: 'home' });
  }
  setLoading(false);
};
</script>
