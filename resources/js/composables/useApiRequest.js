import { ref } from 'vue';
import { useAxiosRequest } from './useAxiosRequest';
import { useSnackbar } from './useSnackbar';
import { useGetErrorMessage } from './useGetErrorMessage';
import { SNACKBAR_COLOR } from '../const/SnackbarColor';

const { axiosPost, axiosPut, axiosDelete, axiosGet } =
  useAxiosRequest();
const { setSnackbar } = useSnackbar();
const { getErrorMessage } = useGetErrorMessage();

export function useApiRequest() {
  const loading = ref(false);

  const setLoading = v => {
    loading.value = v;
  };

  const apiGetRequest = async url => {
    let response;
    try {
      response = await axiosGet(url);
    } catch (error) {
      response = error.response;
    } finally {
      return response;
    }
  };

  const apiPostRequest = async (
    url,
    data = '',
    contentType = ''
  ) => {
    let snackbarMessage, snackbarColor;
    let response;
    try {
      response = await axiosPost(url, data, contentType);
      snackbarMessage = response.data.message;
      snackbarColor = SNACKBAR_COLOR.snackbarSuccessColor;
    } catch (error) {
      snackbarMessage = getErrorMessage(
        url,
        error.response.status
      );
      snackbarColor = SNACKBAR_COLOR.snackbarErrorColor;
      response = error.response;
    } finally {
      setSnackbar(snackbarMessage, snackbarColor);
      return response;
    }
  };

  const apiPutRequest = async (
    url,
    data = '',
    contentType = ''
  ) => {
    let snackbarMessage, snackbarColor;
    let response;
    try {
      response = await axiosPut(url, data, contentType);
      snackbarMessage = response.data.message;
      snackbarColor = SNACKBAR_COLOR.snackbarSuccessColor;
    } catch (error) {
      snackbarMessage = getErrorMessage(
        url,
        error.response.status,
        'put'
      );
      snackbarColor = SNACKBAR_COLOR.snackbarErrorColor;
      response = error.response;
    } finally {
      setSnackbar(snackbarMessage, snackbarColor);
      return response;
    }
  };

  const apiDeleteRequest = async url => {
    let snackbarMessage, snackbarColor;
    let response;
    try {
      response = await axiosDelete(url);
      snackbarMessage = response.data.message;
      snackbarColor = SNACKBAR_COLOR.snackbarSuccessColor;
    } catch (error) {
      snackbarMessage = getErrorMessage(
        url,
        error.response.status,
        'delete'
      );
      snackbarColor = SNACKBAR_COLOR.snackbarErrorColor;
      response = error.response;
    } finally {
      setSnackbar(snackbarMessage, snackbarColor);
      return response;
    }
  };

  return {
    loading,
    setLoading,
    apiGetRequest,
    apiPostRequest,
    apiPutRequest,
    apiDeleteRequest,
  };
}
