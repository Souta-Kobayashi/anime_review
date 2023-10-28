import { createRouter, createWebHistory } from 'vue-router';
const BASE_URL = '/';

const routes = [
  {
    path: '/login',
    name: 'login',
    component: () => import('./pages/Login.vue'),
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('./pages/Register.vue'),
  },
  {
    path: '/',
    name: 'home',
    component: () => import('./pages/Home.vue'),
  },
  {
    // アニメ一覧
    path: '/anime',
    name: 'anime',
    component: () => import('./pages/Anime.vue'),
  },
  {
    // アニメ登録
    path: '/anime/create',
    name: 'anime-create',
    component: () => import('./pages/AnimeCreate.vue'),
  },
  {
    // アニメ詳細
    path: '/anime/:id',
    name: 'anime-show',
    component: () => import('./pages/AnimeShow.vue'),
  },
  {
    // アニメ編集
    path: '/anime/:id/edit',
    name: 'anime-edit',
    component: () => import('./pages/AnimeEdit.vue'),
  },
  {
    // カテゴリリスト
    path: '/category',
    name: 'category',
    component: () => import('./pages/Category.vue'),
  },
  {
    // カテゴリ登録
    path: '/category/create',
    name: 'category-create',
    component: () => import('./pages/CategoryCreate.vue'),
  },
  {
    // カテゴリ編集
    path: '/category/:id/edit',
    name: 'category-edit',
    component: () => import('./pages/CategoryEdit.vue'),
  },
  // {
  //   path: '/about',
  //   name: 'About',
  //   component: About,
  // },
  // {
  //   path: '/item/:id(\\d+)',
  //   name: 'Item',
  //   component: Item,
  // },
  // {
  //   path: '/404',
  //   name: '404-NotFound',
  //   component: NotFound,
  // },
  // {
  //   path: '/:pathMatch(.*)',
  //   redirect: '/404',
  // },
];

const router = createRouter({
  history: createWebHistory(BASE_URL), // set BASE_URL
  routes,
});

export default router;
