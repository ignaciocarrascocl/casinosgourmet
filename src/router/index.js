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

// Tracking de Google Analytics para cambios de ruta
router.afterEach((to, from) => {
  // Verificar que gtag esté disponible
  if (typeof gtag !== 'undefined') {
    gtag('config', 'G-83XSC3WKRD', {
      page_path: to.path,
      page_title: to.name || to.path,
      page_location: window.location.origin + to.fullPath
    })
  }
})

export default router
