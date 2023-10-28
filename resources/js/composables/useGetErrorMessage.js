import {
  ERROR_MESSAGES,
  CONSOLE_MESSAGES,
} from '../const/Messages';

export function useGetErrorMessage() {
  const getErrorMessage = (url, status, method) => {
    let message;
    if (status === 500) {
      message = ERROR_MESSAGES.serverError;
      return message;
    }

    // 動的URL時のパターンマッチ
    const categoryUpdateOrDelete = /api\/category\/\d+/;
    if (categoryUpdateOrDelete.test(url)) {
      switch (status) {
        case 401:
          message = ERROR_MESSAGES.authenticationFailed;
          break;
        case 422:
          if (method === 'put') {
            message = ERROR_MESSAGES.categoryUpdateFailed;
          } else if (method === 'delete') {
            message = ERROR_MESSAGES.categoryDeleteFailed;
          }
          break;
        default:
          break;
      }
      return message;
    }

    // prettier-ignore
    switch (url) {
      case '/api/login':
        message
          = status === 422 ? ERROR_MESSAGES.loginFailed
          : ERROR_MESSAGES.serverError;
        break;
      case '/api/register':
        message
          = status === 422 ? ERROR_MESSAGES.userRegisterFailed
          : ERROR_MESSAGES.serverError;
        break;
      case '/api/anime/create':
        message
          = status === 401 ? ERROR_MESSAGES.authenticationFailed
          : status === 422 ? ERROR_MESSAGES.animeRegisterFailed
          : ERROR_MESSAGES.serverError;
        break
      case '/api/category/create':
        message
          = status === 401 ? ERROR_MESSAGES.authenticationFailed
          : status === 422 ? ERROR_MESSAGES.categoryRegisterFailed
          : ERROR_MESSAGES.serverError;
        break
      case '/api/anime':
        message = CONSOLE_MESSAGES.animeGetFailed;
        break;
      case '/api/category':
        message = CONSOLE_MESSAGES.categoryGetFailed;
        break;
      default:
        message = ERROR_MESSAGES.serverError;
        break;
    }
    return message;
  };

  return {
    getErrorMessage,
  };
}
