import { computed } from 'vue';
import { minLength, required, email, sameAs, helpers } from '@vuelidate/validators';

class CustomValidationRules {
  constructor(currentUrl, form) {
    this.currentUrl = currentUrl;
    this.form = form;
  }

  // エラーメッセージの日本語化対応
  requiredCustomMessage() {
    return helpers.withMessage('必須入力です', required);
  }
  emailCustomMessage() {
    return helpers.withMessage('無効なメールアドレスです', email);
  }
  minLengthCustomMessage(length) {
    return helpers.withMessage(`${length}文字以上の入力が必要です`, minLength(length));
  }
  sameAsPasswordCustomMessage(password) {
    return helpers.withMessage('パスワードと一致しません', sameAs(password));
  }

  registerRules() {
    return computed(() => ({
      name: {
        required: this.requiredCustomMessage(),
      },
      email: {
        required: this.requiredCustomMessage(),
        email: this.emailCustomMessage(),
      },
      password: {
        required: this.requiredCustomMessage(),
        minLengthValue: this.minLengthCustomMessage(8),
      },
      password_confirmation: {
        required: this.requiredCustomMessage(),
        sameAsPassword: this.sameAsPasswordCustomMessage(this.form.password),
      },
    }));
  }

  loginRules() {
    return computed(() => ({
      email: {
        required: this.requiredCustomMessage(),
        email: this.emailCustomMessage(),
      },
      password: {
        required: this.requiredCustomMessage(),
      },
    }));
  }

  getRules() {
    if (this.currentUrl === '/register') {
      return this.registerRules();
    } else if (this.currentUrl === '/login') {
      return this.loginRules();
    }
  }
}

export function getValidationRules(currentUrl, form) {
  const customValidation = new CustomValidationRules(currentUrl, form);
  return customValidation.getRules();
}