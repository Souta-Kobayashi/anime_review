import { ref } from 'vue';
import router from '../router';
import { useAxiosRequest } from './useAxiosRequest';
import { useSnackbar } from './useSnackbar';
import { useGetErrorMessage } from './useGetErrorMessage';

const { axiosLoginPost, axiosPost, axiosGet } =
  useAxiosRequest();
const { setSnackbar } = useSnackbar();
const { getErrorMessage } = useGetErrorMessage();

export function useApiRequest() {
  const loading = ref(false);

  const setLoading = v => {
    loading.value = v;
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
      snackbarColor = 'rgba(2, 136, 209, 0.8)';
      router.push({ name: 'home' });
    } catch (error) {
      snackbarMessage = getErrorMessage(
        url,
        error.response.status
      );
      snackbarColor = 'rgba(255, 87, 34, 0.8)';
      response = error.response;
    } finally {
      setSnackbar(snackbarMessage, snackbarColor);
      return response;
    }
  };

  return {
    loading,
    setLoading,
    apiPostRequest,
  };
}
