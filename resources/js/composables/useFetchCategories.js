import { useApiRequest } from "../composables/useApiRequest";

const { apiGetRequest } = useApiRequest();

export function useFetchCategories() {
  const fetchCategories = async () => {
    const result = await apiGetRequest("/api/category");
    if (result.status === 200) {
      return result.data;
    }
    return null;
  };

  return { fetchCategories };
}
