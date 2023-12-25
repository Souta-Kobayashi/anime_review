import { useApiRequest } from '../composables/useApiRequest';

const { apiGetRequest } = useApiRequest();

export function useFetchAnimeList() {
  const fetchAnimeList = async () => {
    const result = await apiGetRequest('/api/anime');
    if (result.status === 200) {
      return result.data;
    }
    return null;
  };

  return { fetchAnimeList };
}
