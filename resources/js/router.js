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
    path: '/anime/:id(\\d+)',
    name: 'anime-show',
    component: () => import('./pages/AnimeShow.vue'),
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
  // {
  //   path: '/about',
  //   name: 'About',
  //   component: About,
  // },
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: () => import('./pages/NotFoundView.vue'),
  },
];

const router = createRouter({
  history: createWebHistory(BASE_URL), // set BASE_URL
  routes,

  // ページ遷移時のスクロール動作
  scrollBehavior(to, from, savedPosition) {
    // ブラウザの進む/戻る操作時の挙動
    if (savedPosition) {
      return new Promise((resolve, reject) => {
        setTimeout(() => {
          resolve(savedPosition);
        }, 1000);
      });
    } else {
      return { top: 0, left: 0 };
    }
  },
});

export default router;
