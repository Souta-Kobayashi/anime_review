import { createRouter, createWebHistory } from 'vue-router'
const BASE_URL = '/'

// import Home from './components/Home.vue'
// import About from './components/About.vue'
// import Item from './components/Item.vue'
// import NotFound from './components/404.vue'
import HomePage from './pages/HomePage.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
  },
  {
    // アニメ一覧
    path: '/anime',
    name: 'anime',
    component: () => import('./pages/AnimePage.vue'),
  },
  {
    // アニメ登録
    path: '/anime/create',
    name: 'anime-create',
    component: () => import('./pages/AnimeCreatePage.vue'),
  },
  {
    // アニメ詳細
    path: '/anime/:id',
    name: 'anime-show',
    component: () => import('./pages/AnimeShowPage.vue'),
  },
  {
    // アニメ編集
    path: '/anime/:id/edit',
    name: 'anime-edit',
    component: () => import('./pages/AnimeEditPage.vue'),
  },
  {
    // カテゴリリスト
    path: '/category',
    name: 'category',
    component: () => import('./pages/CategoryPage.vue'),
  },
  {
    // カテゴリ登録
    path: '/category/create',
    name: 'category-create',
    component: () => import('./pages/CategoryCreatePage.vue'),
  },
  {
    // カテゴリ編集
    path: '/category/:id/edit',
    name: 'category-edit',
    component: () => import('./pages/CategoryEditPage.vue'),
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
]

const router = createRouter({
  history: createWebHistory(BASE_URL),  // set BASE_URL
  routes
})

export default router
