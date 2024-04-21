<template>
  <td class="text-end">
    <div v-if="isLoginStatus">
      <span class="me-4">
        <AtomPencilIcon
          @click="$emit('showDialog', 'edit')"
        />
      </span>
      <span>
        <AtomDeleteIcon
          @click="$emit('showDialog', 'destroy')"
        />
      </span>
    </div>
  </td>
</template>

<script setup>
import AtomDeleteIcon from "../../atoms/icon/AtomDeleteIcon.vue";
import AtomPencilIcon from "../../atoms/icon/AtomPencilIcon.vue";

defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
});
defineEmits(["showDialog"]);
</script>
