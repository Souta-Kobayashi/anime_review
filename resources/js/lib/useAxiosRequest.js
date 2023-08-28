export function useAxiosRequest() {
  const axiosPost = (url, form) => {
    axios.get('/sanctum/csrf-cookie');
    const result = axios.post(url, form);
    return result;
  }

  return {
    axiosPost
  }
}