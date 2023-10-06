import { ref } from "vue";
import { useAxiosRequest } from './useAxiosRequest';

const { axiosGet } = useAxiosRequest();

const isLoginStatus = ref(false);
const isDataReady = ref(false);

export function useIsLoggedIn() {
  const setLoginStatus = (isLoggedIn) => {
    isLoginStatus.value = isLoggedIn;
  }

  const setDataReady = (isReady) => {
    isDataReady.value = isReady;
  }

  const fetchLoginStatus = async () => {
    try {
      return await axiosGet('/api/isLoggedIn');
    } catch (error) {
      console.log(error);
      return null;
    }
  };

  return {
    isLoginStatus,
    isDataReady,
    setLoginStatus,
    setDataReady,
    fetchLoginStatus,
  }
}