import ERROR_MESSAGES from '../const/Messages';

export function useGetErrorMessage() {
  const getErrorMessage = (url, status) => {
    let message;
    if (status === 500) {
      message = ERROR_MESSAGES.serverError;
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
