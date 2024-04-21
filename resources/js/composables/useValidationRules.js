import { computed } from "vue";
import {
  minLength,
  required,
  email,
  sameAs,
  helpers,
  not,
} from "@vuelidate/validators";

class CustomValidationRules {
  constructor(currentUrl, form) {
    this.currentUrl = currentUrl;
    this.form = form;
  }

  // エラーメッセージの日本語化対応
  requiredCustomMessage() {
    return helpers.withMessage("必須入力です", required);
  }
  emailCustomMessage() {
    return helpers.withMessage(
      "無効なメールアドレスです",
      email
    );
  }
  minLengthCustomMessage(length) {
    return helpers.withMessage(
      `${length}文字以上の入力が必要です`,
      minLength(length)
    );
  }
  sameAsPasswordCustomMessage(password) {
    return helpers.withMessage(
      "パスワードと一致しません",
      sameAs(password)
    );
  }
  sameAsCategoryNameCustomMessage(categoryName) {
    return helpers.withMessage(
      "異なるカテゴリー名を入力してください",
      not(sameAs(categoryName))
    );
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
        sameAsPassword: this.sameAsPasswordCustomMessage(
          this.form.password
        ),
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

  animeCreateRules() {
    return computed(() => ({
      animeName: {
        required: this.requiredCustomMessage(),
      },
      synopsis: {},
      keyVisualImage: {},
      keyVisualReference: {},
    }));
  }

  categoryCreateRules() {
    return computed(() => ({
      name: {
        required: this.requiredCustomMessage(),
      },
    }));
  }

  categoryUpdateRules() {
    return computed(() => ({
      name: {
        required: this.requiredCustomMessage(),
        sameAsRawValue:
          this.sameAsCategoryNameCustomMessage(
            this.form.name
          ),
      },
    }));
  }

  getRules() {
    switch (this.currentUrl) {
      case "/register":
        return this.registerRules();
      case "/login":
        return this.loginRules();
      case "/anime/create":
        return this.animeCreateRules();
      case "/category/create":
        return this.categoryCreateRules();
      case "/category": // category edit dialog
        return this.categoryUpdateRules();
      default:
        console.log("Unknown Rules.");
    }
  }
}

export function getValidationRules(currentUrl, form) {
  const customValidation = new CustomValidationRules(
    currentUrl,
    form
  );
  return customValidation.getRules();
}
