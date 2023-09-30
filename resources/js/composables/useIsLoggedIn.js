import { ref } from "vue";
import { useAxiosRequest } from './useAxiosRequest';

const { axiosGet } = useAxiosRequest();

const isLoginStatus = ref(false);

export function useIsLoggedIn() {
  const setLoginStatus = (isLoggedIn) => {
    isLoginStatus.value = isLoggedIn;
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
    setLoginStatus,
    fetchLoginStatus,
  }
}