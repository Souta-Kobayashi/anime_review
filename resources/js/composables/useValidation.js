import router from '../router';
import { reactive } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { getValidationRules } from './useValidationRules';

export function useValidate(form) {
  const currentUrl = router.options.history.location;
  const rules = getValidationRules(currentUrl, form);
  const serverValidationErrMessage = reactive({ ...form });
  // vuelidateのインスタンス生成
  const v$ = useVuelidate(rules, form);

  // フォーカスが外れた時実行される
  const blurExecVuelidate = field => {
    serverValidationErrMessage[field] = ''; // サーバーエラーメッセージ削除
    // 初回フロントバリデーション用の処理
    // NOTE: $touch()によって、バリデーションの実行に加えて初回バリデーションを行ったフラグが立てられる
    // 以降は入力に応じて自動でバリデーションが行われる
    v$.value[field].$touch();
  };

  // バリデーションの結果を表示
  const getErrMessage = fieldName => {
    // vuelidateのエラーメッセージ
    const fieldErrors = v$.value[fieldName]?.$errors;
    if (fieldErrors && fieldErrors.length !== 0)
      return fieldErrors
        .map(error => error.$message)
        .join(', ');

    // サーバーからのエラーメッセージ
    const serverErrors =
      serverValidationErrMessage[fieldName];
    if (serverErrors) return serverErrors;
  };

  const setServerValidationError = errObject => {
    for (const key in errObject) {
      serverValidationErrMessage[key] = errObject[key][0];
      getErrMessage(key);
    }
  };

  return {
    blurExecVuelidate,
    getErrMessage,
    setServerValidationError,
  };
}
