import {
  snakeCase,
  isArray,
  isObject,
  mapValues,
  mapKeys,
} from 'lodash';

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

  const axiosPut = (url, form = '', header = '') => {
    const mapKeysDeep = (data, callback) => {
      if (isArray(data)) {
        return data.map(innerData =>
          mapKeysDeep(innerData, callback)
        );
      } else if (isObject(data)) {
        return mapValues(mapKeys(data, callback), val =>
          mapKeysDeep(val, callback)
        );
      } else {
        return data;
      }
    };

    const mapKeysSnakeCase = data =>
      mapKeysDeep(data, (_value, key) => snakeCase(key));

    const requestInterceptors =
      axios.interceptors.request.use(
        ({ data, ...request }) => {
          const convertedData = mapKeysSnakeCase(data);
          return { ...request, data: convertedData };
        },
        error => {
          console.error(
            'Request interceptor error:',
            error
          );
          return Promise.reject(error);
        }
      );

    return axios.put(url, form, header).finally(() => {
      // interceptorを解除
      axios.interceptors.request.eject(requestInterceptors);
    });
  };

  const axiosDelete = url => {
    return axios.delete(url);
  };

  const axiosGet = url => {
    return axios.get(url);
  };

  return {
    axiosLoginPost,
    axiosPost,
    axiosPut,
    axiosDelete,
    axiosGet,
  };
}
