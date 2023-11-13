<template>
  <header class="header">
    <div class="container header-container">
      <div class="logo">
        <RouterLink to="/">AnimeReview</RouterLink>
      </div>

      <div class="menu-wrapper" v-if="isDataReady">
        <ul class="menu-contents">
          <MoleculePcNavMenu />
          <MoleculePcNavRegisterMenu v-if="isLoginStatus" />
        </ul>
      </div>
      <MoleculePcNavUserMenu
        v-if="isDataReady"
        :is-login-status="isLoginStatus"
        @user-logout="userLogout"
      />
      <MoleculeSpNavMenu
        v-if="isDataReady"
        :is-login-status="isLoginStatus"
        @toggle-hamburger-menu="
          toggleHamburgerMenu = !toggleHamburgerMenu
        "
        @user-logout="userLogout"
      />
    </div>

    <MoleculeHamburgerMenu
      :is-login-status="isLoginStatus"
      :toggle-hamburger-menu="toggleHamburgerMenu"
      @set-hamburger-contents="
        e => (hamburgerContents = e.value)
      "
      @show-hamburger="
        e => (e.style.height = e.scrollHeight + 'px')
      "
      @close-hamburger="e => (e.style.height = '0')"
      @show-hamburger-inner="
        e =>
          changeHamburgerMenuHeight({
            e,
            increaseHeight: true,
          })
      "
      @close-hamburger-inner="
        e =>
          changeHamburgerMenuHeight({
            e,
            increaseHeight: false,
          })
      "
    />
  </header>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useApiRequest } from '../composables/useApiRequest';
import MoleculePcNavMenu from '../molecules/MoleculePcNavMenu.vue';
import MoleculePcNavRegisterMenu from '../molecules/MoleculePcNavRegisterMenu.vue';
import MoleculePcNavUserMenu from '../molecules/MoleculePcNavUserMenu.vue';
import MoleculeSpNavMenu from '../molecules/MoleculeSpNavMenu.vue';
import MoleculeHamburgerMenu from '../molecules/MoleculeHamburgerMenu.vue';
import { useIsLoggedIn } from '../composables/useIsLoggedIn';

// prettier-ignore
const {
  isLoginStatus,
  isDataReady,
  setLoginStatus,
  setDataReady,
  fetchLoginStatus,
} = useIsLoggedIn();

const { apiPostRequest } = useApiRequest();

const route = useRoute();
const path = computed(() => route.path);
const toggleHamburgerMenu = ref(false);
const hamburgerContents = ref(null);

// ログイン判定
(async () => {
  const fls = await fetchLoginStatus();
  setLoginStatus(fls?.data.status === 200);
  setDataReady(true);
})();

onMounted(() => {
  // ページ遷移時にドロップダウンが閉じない現象を修正
  watch(path, () => {
    const el = document.querySelector('nav .dropdown ul');
    if (el) el.classList.remove('show');
  });
});

// ドロップダウン内のリンクを開いているか判定
const isDropdownItemActive = computed(() => {
  return (
    path.value === '/anime/create' ||
    path.value === '/category/create'
  );
});

// logout
const userLogout = async () => {
  const result = await apiPostRequest('/api/logout');
  if (result.status) setLoginStatus(false);
};

// ハンバーガーメニューのinnerのtoggleに併せてheightを変更
const changeHamburgerMenuHeight = ({
  e,
  increaseHeight,
}) => {
  const currentHeight = parseInt(
    hamburgerContents.value.style.height
  );
  const newHeight = increaseHeight
    ? currentHeight + parseInt(e.scrollHeight)
    : currentHeight - parseInt(e.scrollHeight);
  hamburgerContents.value.style.height = newHeight + 'px';
};
</script>