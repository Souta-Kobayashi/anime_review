import { ref } from "vue";
import { useAxiosRequest } from "./useAxiosRequest";

const { axiosGet } = useAxiosRequest();

const isLoginStatus = ref(false);
const isDataReady = ref(false);

export function useIsLoggedIn() {
  const setLoginStatus = v => {
    isLoginStatus.value = v;
  };

  const setDataReady = v => {
    isDataReady.value = v;
  };

  const fetchLoginStatus = async () => {
    try {
      return await axiosGet("/api/isLoggedIn");
    } catch (error) {
      return null;
    }
  };

  return {
    isLoginStatus,
    isDataReady,
    setLoginStatus,
    setDataReady,
    fetchLoginStatus,
  };
}
