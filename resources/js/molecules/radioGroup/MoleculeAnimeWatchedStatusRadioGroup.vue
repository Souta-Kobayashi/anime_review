<template>
  <v-radio-group class="pt-5 justify-items-center">
    <v-radio
      class="me-3"
      label="未視聴"
      :value="10"
    ></v-radio>
    <v-radio
      class="me-3"
      label="視聴中"
      :value="20"
    ></v-radio>
    <v-radio
      class="me-3"
      label="視聴断念"
      :value="30"
    ></v-radio>
    <v-radio label="視聴済" :value="40"></v-radio>
  </v-radio-group>
</template>
