<template>
  <td class="text-end">
    <div>
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
import AtomDeleteIcon from '../atoms/icon/AtomDeleteIcon.vue';
import AtomPencilIcon from '../atoms/icon/AtomPencilIcon.vue';

const props = defineProps({
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits(['showDialog']);
</script>
