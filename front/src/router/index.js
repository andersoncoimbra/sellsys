import { createRouter, createWebHistory } from 'vue-router'

// Importação das páginas/componentes
import Vendedores from '../pages/Vendedores.vue'
import Vendas from '../pages/Vendas.vue'
import VendasPorVendedor from '../pages/VendasPorVendedor.vue'
import Login from '../pages/Login.vue'
import AdminReenvioEmail from '../pages/AdminReenvioEmail.vue'

const routes = [
    {path: '/login', name: 'login', component: Login },
    { path: '/', name: 'home', component: Vendedores, meta: { auth: true } },
    { path: '/vendas', name: 'vendas', component: Vendas, meta: { auth: true } },
    { path: '/vendas-por-vendedor', name: 'vendas-por-vendedor', component: VendasPorVendedor, meta: { auth: true } },
    { path: '/admin-reenvio-email', name: 'admin-reenvio-email', component: AdminReenvioEmail, meta: { auth: true } },


]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const isAuth = !!localStorage.getItem('token')
  if (to.meta.auth && !isAuth) {
    return next('/login')
  }
  next()
})

export default router
