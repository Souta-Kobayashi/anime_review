<script setup>
import Counter from "./components/Counter.vue";
import logo from "../images/logo-with-shadow.png";
// import header from './components/header.vue';
</script>

<template>
    <router-view></router-view>
    <!-- header template -->
    <h1>Hello World</h1>
    <img :src="logo" />
    <Counter />
</template>