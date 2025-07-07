import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/trabaja-con-nosotros',
      name: 'trabaja-con-nosotros',
      component: () => import('../views/TrabajaConNosotrosView.vue'),
    },
  ],
  scrollBehavior(to, from, savedPosition) {
    // Siempre ir al top de la página
    return { top: 0 }
  },
})

export default router
