<template>
  <header class="header">
    <div class="container header-container">
      <div class="logo">
        <RouterLink to="/" aria-label="TOPページに遷移する"
          >AnimeReview</RouterLink
        >
      </div>

      <div v-if="isDataReady" class="menu-wrapper">
        <ul class="menu-contents">
          <MoleculePcNavMenu />
          <MoleculePcNavRegisterMenu v-if="isLoginStatus" />
        </ul>
      </div>
      <MoleculePcNavUserMenu
        v-if="isDataReady"
        :is-login-status="isLoginStatus"
        @user-logout="showLogoutDialog = true"
      />
      <MoleculeSpNavMenu
        v-if="isDataReady"
        :is-login-status="isLoginStatus"
        :hamburger-menu-toggle="hamburgerMenuToggle"
        @user-logout="showLogoutDialog = true"
        @set-hamburger-menu-toggle="
          hamburgerMenuToggle = !hamburgerMenuToggle
        "
      />
    </div>

    <MoleculeHamburgerMenu
      :is-login-status="isLoginStatus"
      :hamburger-menu-toggle="hamburgerMenuToggle"
      @set-hamburger-menu-toggle="
        hamburgerMenuToggle = !hamburgerMenuToggle
      "
    />
    <LogoutDialog
      v-model="showLogoutDialog"
      @close-dialog="showLogoutDialog = false"
      @user-logout="userLogout"
    />
  </header>
  <AtomSiteMessage />
</template>

<script setup>
import { ref, computed, onMounted, watch } from "vue";
import { useRoute } from "vue-router";
import { useApiRequest } from "../composables/useApiRequest";
import AtomSiteMessage from "../atoms/notify/AtomSiteMessage.vue";
import MoleculePcNavMenu from "../molecules/menu/MoleculePcNavMenu.vue";
import MoleculePcNavRegisterMenu from "../molecules/menu/MoleculePcNavRegisterMenu.vue";
import MoleculePcNavUserMenu from "../molecules/menu/MoleculePcNavUserMenu.vue";
import MoleculeSpNavMenu from "../molecules/menu/MoleculeSpNavMenu.vue";
import MoleculeHamburgerMenu from "../molecules/menu/MoleculeHamburgerMenu.vue";
import LogoutDialog from "../organisms/LogoutDialog.vue";
import { useIsLoggedIn } from "../composables/useIsLoggedIn";

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
const showLogoutDialog = ref(false);
const hamburgerMenuToggle = ref(false);

// ログイン判定
(async () => {
  const fls = await fetchLoginStatus();
  setLoginStatus(fls?.data.status === 200);
  setDataReady(true);
})();

onMounted(() => {
  // ページ遷移時にドロップダウンが閉じない現象を修正
  watch(path, () => {
    const el = document.querySelector("nav .dropdown ul");
    if (el) el.classList.remove("show");
  });
});

// ドロップダウン内のリンクを開いているか判定
// const isDropdownItemActive = computed(() => {
//   return (
//     path.value === '/anime/create' ||
//     path.value === '/category/create'
//   );
// });

// logout
const userLogout = async () => {
  const result = await apiPostRequest("/api/logout");
  if (result.status) setLoginStatus(false);
  showLogoutDialog.value = false;
};
</script>
