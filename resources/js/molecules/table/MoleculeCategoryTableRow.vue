<template>
  <tr>
    <td>{{ categoryName }}</td>
    <MoleculeCategoryActionMenu
      :is-login-status="isLoginStatus"
      @show-dialog="
        type => {
          $emit(
            'showDialog',
            type,
            categoryId,
            categoryName
          );
        }
      "
    />
  </tr>
</template>

<script setup>
import { useIsLoggedIn } from '../../composables/useIsLoggedIn';
import MoleculeCategoryActionMenu from '../iconGroup/MoleculeCategoryActionMenu.vue';

const props = defineProps({
  categoryId: {
    type: Number,
    default: null,
  },
  categoryName: {
    type: String,
    default: '',
  },
});
const emit = defineEmits(['showDialog']);

const { isLoginStatus } = useIsLoggedIn();
</script>
