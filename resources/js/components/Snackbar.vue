<template>
  <v-snackbar
    v-model="shouldShowSnackbar"
    :color="snackbarColor"
    :timeout="snackbarTimeout"
  >
    {{ snackbarMessage }}
  </v-snackbar>
</template>

<script setup>
import { useSnackbar } from "../lib/useSnackbar";

const {
  snackbarMessage,
  snackbarColor,
  shouldShowSnackbar,
  snackbarTimeout,
} = useSnackbar();
</script>