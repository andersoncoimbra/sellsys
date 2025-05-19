<template>

  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input v-model="email" type="email" class="form-control" id="inputEmail3" placeholder="admin@teste.com">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input  v-model="password" type="password" class="form-control" id="inputPassword3" placeholder="senha123">
    </div>
  </div>

  <button @click="login" class="btn btn-primary">Login</button>
</template>

<script>
import api from '../services/api'

export default {
  data() {
    return {
      email: '',
      password: '',
      erro: ''
    }
  },
  methods: {
    async login() {
      this.erro = ''
      try {
        const res = await api.post('/login', {
          email: this.email,
          password: this.password
        })
        localStorage.setItem('token', res.data.token)
        this.$router.push('/dashboard') // ou a rota principal
      } catch (e) {
        this.erro = 'Login inválido'
      }
    }
  }
}
</script>
