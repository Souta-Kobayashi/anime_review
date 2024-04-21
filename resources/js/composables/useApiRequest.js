import { ref } from "vue";
import { useAxiosRequest } from "./useAxiosRequest";
import { useGetErrorMessage } from "./useGetErrorMessage";
import { toast } from "vuetify-sonner";

const { axiosPost, axiosPut, axiosDelete, axiosGet } =
  useAxiosRequest();
const { getErrorMessage } = useGetErrorMessage();

export function useApiRequest() {
  const loading = ref(false);

  const setLoading = v => {
    loading.value = v;
  };

  const apiGetRequest = async url => {
    try {
      return await axiosGet(url);
    } catch (error) {
      return error.response;
    }
  };

  const apiPostRequest = async (
    url,
    data = "",
    contentType = ""
  ) => {
    let snackbarMessage;
    let response;
    try {
      response = await axiosPost(url, data, contentType);
      snackbarMessage = response.data.message;
      toast.success(snackbarMessage);
      return response;
    } catch (error) {
      snackbarMessage = getErrorMessage(
        url,
        error.response.status
      );
      response = error.response;
      toast.warning(snackbarMessage);
      return response;
    }
  };

  const apiPutRequest = async (
    url,
    data = "",
    contentType = ""
  ) => {
    let snackbarMessage;
    let response;
    try {
      response = await axiosPut(url, data, contentType);
      snackbarMessage = response.data.message;
      toast.success(snackbarMessage);
      return response;
    } catch (error) {
      snackbarMessage = getErrorMessage(
        url,
        error.response.status,
        "put"
      );
      toast.warning(snackbarMessage);
      response = error.response;
      return response;
    }
  };

  const apiDeleteRequest = async url => {
    let snackbarMessage;
    let response;
    try {
      response = await axiosDelete(url);
      snackbarMessage = response.data.message;
      toast.success(snackbarMessage);
      return response;
    } catch (error) {
      snackbarMessage = getErrorMessage(
        url,
        error.response.status,
        "delete"
      );
      toast.warning(snackbarMessage);
      response = error.response;
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
