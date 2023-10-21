export function useAxiosRequest() {
  const axiosGetCsrfCookie = () => {
    axios.get('/sanctum/csrf-cookie');
  };

  const axiosLoginPost = (url, form) => {
    axiosGetCsrfCookie();
    return axios.post(url, form);
  };

  const axiosPost = (url, form = '', header = '') => {
    if (url === '/api/login') {
      return axiosLoginPost(url, form);
    }
    return axios.post(url, form, header);
  };

  const axiosGet = url => {
    return axios.get(url);
  };

  return {
    axiosLoginPost,
    axiosPost,
    axiosGet,
  };
}