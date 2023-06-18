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

<template>
  <header>
    <nav class="p-3 bg-dark text-white">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <!-- nav -->
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li>
              <router-link to="/" class="nav-link px-2" active-class="text-white">TOP</router-link>
            </li>
            <li>
              <router-link to="/anime" class="nav-link px-2" active-class="text-white">アニメ一覧</router-link>
            </li>
            <li>
              <router-link to="/category" class="nav-link px-2" active-class="text-white">カテゴリ</router-link>
            </li>
            <li class="dropdown">
              <a class="nav-link dropdown-toggle px-2" 
                id="create-menu-dropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                :class="{ 'text-white': isDropdownItemActive }">登録メニュー</a>
              <ul ref="sample" class="dropdown-menu p-2" aria-labelledby="create-menu-dropdown">
                <li><router-link to="/anime/create" class="dropdown-item rounded-2">アニメ登録</router-link></li>
                <li><router-link to="/category/create" class="dropdown-item rounded-2">カテゴリ登録</router-link></li>
              </ul>
            </li>
          </ul>
          <!-- search -->
          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
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

<style scoped>
nav .nav-link {
  color: rgba(255, 255, 255, 0.5);
}
nav .dropdown-item:active {
  background: var(--bs-gray-300);
  color: initial;
}

/* PC */
@media (hover: hover) {
  nav .nav-link:hover {
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity));
  }
}
</style>