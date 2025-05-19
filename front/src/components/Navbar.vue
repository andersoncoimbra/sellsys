<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">Sistema de Vendas</router-link>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <router-link class="nav-link" to="/">Vendedores</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/vendas">Vendas</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/vendas-por-vendedor">Vendas Por Vendedor</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/admin-reenvio-email">Email</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
}
</script>
