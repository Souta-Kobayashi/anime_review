<script setup>
import Counter from "./components/Counter.vue";
import logo from "../images/logo-with-shadow.png";
</script>

<template>
    <h1>Hello World</h1>
    <img :src="logo" />
    <Counter />
</template>