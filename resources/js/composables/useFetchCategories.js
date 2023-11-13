import { useApiRequest } from '../composables/useApiRequest';

const { apiGetRequest } = useApiRequest();

export function useFetchCategories() {
  const fetchCategories = async () => {
    const result = await apiGetRequest('/api/category');
    if (result.status === 200) {
      const categoryItems = result.data.map(
        item => item.category_name
      );
      return categoryItems;
    }
    return null;
  };

  return { fetchCategories };
}
