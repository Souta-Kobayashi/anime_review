<script setup>
// export default {
//   methods: {
//     search() {
//       // 検索ボタンのクリックイベントの処理
//     },
//   },
// };
</script>

<template>
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <!-- nav -->
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li>
            <router-link to="/" class="nav-link px-2 text-white">TOP</router-link>
          </li>
          <li>
            <router-link to="/anime" class="nav-link px-2 text-white">アニメ一覧</router-link>
          </li>
          <li>
            <router-link to="/category" class="nav-link px-2 text-white">カテゴリ</router-link>
          </li>
          <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle px-2 text-white" 
              id="create-menu-dropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">登録メニュー</a>
            <ul class="dropdown-menu" aria-labelledby="create-menu-dropdown">
              <li><router-link to="/anime/create" class="dropdown-item">アニメ登録</router-link></li>
              <li><router-link to="/category/create" class="dropdown-item">カテゴリ登録</router-link></li>
            </ul>
          </li>
        </ul>

        <!-- search -->
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="アニメを探す" aria-label="Search">
        </form>

        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Login</button>
          <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
      </div>
    </div>
  </header>
</template>
