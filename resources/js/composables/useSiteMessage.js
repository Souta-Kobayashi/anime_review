import { ref } from "vue";

const visibleSiteMessage = ref(true);

export function useSiteMessage() {
  return {
    visibleSiteMessage,
  };
}
