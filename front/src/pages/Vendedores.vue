<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Cadastro de Vendedores</h1>

    <form @submit.prevent="criarVendedor" class="space-y-4 mb-6">
      <input v-model="form.nome" type="text" placeholder="Nome" class="w-full p-2 border rounded" />
      <input v-model="form.email" type="email" placeholder="E-mail" class="w-full p-2 border rounded" />
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Cadastrar
      </button>
    </form>

    <div v-if="mensagem" class="mb-4 text-green-600">{{ mensagem }}</div>

    <h2 class="text-xl font-semibold mb-2">Lista de Vendedores</h2>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>Nome</th>
        <th>E-mail</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="vendedor in vendedores" :key="vendedor.id">
        <td>{{ vendedor.nome }}</td>
        <td>{{ vendedor.email }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from '../services/api'

export default {
  name: 'Vendedores',
  data() {
    return {
      form: {
        nome: '',
        email: ''
      },
      vendedores: [],
      mensagem: ''
    }
  },
  methods: {
    async buscarVendedores() {
      const response = await api.get('/vendedores')
      this.vendedores = response.data.data
    },
    async criarVendedor() {
      try {
        await api.post('/vendedores', this.form)
        this.mensagem = 'Vendedor cadastrado com sucesso!'
        this.form.nome = ''
        this.form.email = ''
        this.buscarVendedores()
      } catch (error) {
        this.mensagem = 'Erro ao cadastrar vendedor.'
      }
    }
  },
  mounted() {
    this.buscarVendedores()
  }
}
</script>

<style scoped>
input:focus {
  outline: none;
  border-color: #2563eb;
}
</style>
