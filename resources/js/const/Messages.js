// prettier-ignore
const ERROR_MESSAGES = {
  serverError:             '想定外のエラーが発生しました。再度お試しください',
  animeGetFailed:          'アニメの取得に失敗しました',
  animeInfoUpdateFailed:   'アニメ情報の更新に失敗しました。エラーメッセージを確認してください',
  animeRatingUpdateFailed: 'アニメのレビューに失敗しました',
  animeDeleteFailed:       'アニメの削除に失敗しました',
  animeRegisterFailed:     'アニメの登録に失敗しました。エラーメッセージを確認してください',
  categoryRegisterFailed:  'カテゴリの登録に失敗しました。エラーメッセージを確認してください',
  categoryUpdateFailed:    'カテゴリ名の変更に失敗しました。エラーメッセージを確認してください',
  categoryDeleteFailed:    'カテゴリの削除に失敗しました',
  loginFailed:             'ログインに失敗しました',
  authenticationFailed:    '再度ログインしてください',
  userRegisterFailed:      'ユーザー登録に失敗しました。エラーメッセージを確認してください',
};

// prettier-ignore
const CONSOLE_MESSAGES = {
  animeGetFailed:    'Failed to retrieve list of animations.',
  categoryGetFailed: 'Failed to retrieve list of categories.',
};
// const SUCCESS_MESSAGES = {
// }

export { ERROR_MESSAGES, CONSOLE_MESSAGES };
