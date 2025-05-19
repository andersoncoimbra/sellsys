<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Cadastro de Vendas</h1>

    <form @submit.prevent="cadastrarVenda" class="space-y-4 mb-6">
      <select v-model="form.vendedor_id" class="w-full p-2 border rounded">
        <option disabled value="">Selecione um vendedor</option>
        <option v-for="vendedor in vendedores" :key="vendedor.id" :value="vendedor.id">
          {{ vendedor.nome }}
        </option>
      </select>

      <input v-model="form.valor" type="number" step="0.01" placeholder="Valor da venda" class="w-full p-2 border rounded" />
      <input v-model="form.data" type="date" class="w-full p-2 border rounded" />

      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Cadastrar Venda
      </button>
    </form>

    <div v-if="mensagem" class="mb-4 text-green-600">{{ mensagem }}</div>

    <h2 class="text-xl font-semibold mb-2">Vendas cadastradas</h2>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>Data</th>
        <th>Vendedor</th>
        <th>Valor</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="venda in vendas" :key="venda.id">
        <td>{{ formataData(venda.data) }}</td>
        <td>{{ venda.vendedor.nome }}</td>
        <td>R$ {{ venda.valor }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from '../services/api'

export default {
  name: 'Vendas',
  data() {
    return {
      vendedores: [],
      vendas: [],
      form: {
        vendedor_id: '',
        valor: '',
        data: ''
      },
      mensagem: ''
    }
  },
  methods: {
    async carregarVendedores() {
      const res = await api.get('/vendedores')
      this.vendedores = res.data.data
    },
    async carregarVendas() {
      const res = await api.get('/vendas')
      this.vendas = res.data.data
    },
    async cadastrarVenda() {
      try {
        await api.post('/vendas', this.form)
        this.mensagem = 'Venda cadastrada com sucesso!'
        this.form = { vendedor_id: '', valor: '', data: '' }
        this.carregarVendas()
      } catch (err) {
        this.mensagem = 'Erro ao cadastrar venda.'
      }
    },
    //uma funcao para transforma a data no formato brasileiro
    formataData(data) {
      const partes = data.split('-')
      return `${partes[2]}/${partes[1]}/${partes[0]}`
    }
  },
  mounted() {
    this.carregarVendedores()
    this.carregarVendas()
  }
}
</script>
