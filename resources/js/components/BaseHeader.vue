<template>
  <header>
    <nav class="navbar navbar-expand-lg bg-dark">
      <div class="container">
        <div class="d-flex flex-wrap w-100 align-items-center justify-content-lg-start justify-content-between">
          <router-link to="/" class="navbar-brand align-items-center text-white fs-4 text-decoration-none">Anime Review</router-link>

          <!-- nav -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center me-lg-auto" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <router-link to="/" class="nav-link" active-class="text-white">TOP</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/anime" class="nav-link" active-class="text-white">アニメ一覧</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/category" class="nav-link" active-class="text-white">カテゴリ</router-link>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" 
                  id="create-menu-dropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  :class="{ 'text-white': isDropdownItemActive }">登録メニュー</a>
                <ul class="dropdown-menu p-2" aria-labelledby="create-menu-dropdown">
                  <li><router-link to="/anime/create" class="dropdown-item rounded-2">アニメ登録</router-link></li>
                  <li><router-link to="/category/create" class="dropdown-item rounded-2">カテゴリ登録</router-link></li>
                </ul>
              </li>
            </ul>
          </div>

          <!-- search -->
          <!-- col-9は要調整 -->
          <form class="col-9 col-lg-auto mb-lg-0 mb-2">
            <input type="search" class="form-control form-control-dark" placeholder="アニメを探す" aria-label="Search">
          </form>

          <div class="text-end" v-if=false>
            <button type="button" class="btn btn-outline-light me-2">Login</button>
            <button type="button" class="btn btn-warning">Sign-up</button>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { computed, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const path = computed(() => route.path);

// ドロップダウン内のリンクを開いているか判定
const isDropdownItemActive = computed(() => {
  return path.value === '/anime/create' || path.value === '/category/create';
});

onMounted(() => {
  // ページ遷移時にドロップダウンが閉じない現象を修正
  watch(path, () => {
    const el = document.querySelector('nav .dropdown ul');
    if (el) el.classList.remove('show');
  });
});
</script>