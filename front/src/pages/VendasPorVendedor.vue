<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Vendas por Vendedor</h1>

    <select v-model="vendedorSelecionado" @change="buscarVendas" class="w-full p-2 border rounded mb-6">
      <option disabled value="">Selecione um vendedor</option>
      <option v-for="v in vendedores" :key="v.id" :value="v.id">
        {{ v.nome }}
      </option>
    </select>

    <div v-if="vendas.length">
      <table class="table table-striped mb-4">
        <thead>
          <tr>
        <th>Data</th>
        <th>Valor</th>
        <th>Comissão</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="venda in vendas" :key="venda.id">
        <td>{{ venda.data }}</td>
        <td>R$ {{ parseFloat(venda.valor).toFixed(2) }}</td>
        <td>R$ {{ (parseFloat(venda.valor) * 0.085).toFixed(2) }}</td>
          </tr>
        </tbody>
      </table>

      <div class="alert alert-info font-semibold" role="alert">
        Total de vendas: R$ {{ totalVendas.toFixed(2) }} <br />
        Total de comissão: R$ {{ totalComissao.toFixed(2) }}
      </div>
    </div>

    <div v-else-if="vendedorSelecionado">
      <p>Este vendedor ainda não possui vendas cadastradas.</p>
    </div>
  </div>
</template>

<script>
import api from '../services/api'

export default {
  name: 'VendasPorVendedor',
  data() {
    return {
      vendedores: [],
      vendedorSelecionado: '',
      vendas: [],
    }
  },
  computed: {
    totalVendas() {
      let total = 0
        this.vendas.forEach(venda => {
            total += parseFloat(venda.valor)
        })
        return total
    },
    totalComissao() {
      return this.totalVendas * 0.085
    }
  },
  methods: {
    async carregarVendedores() {
      const res = await api.get('/vendedores')
      this.vendedores = res.data.data
    },
    async buscarVendas() {
      if (!this.vendedorSelecionado) return
      const res = await api.get(`/vendas/${this.vendedorSelecionado}`)
      this.vendas = res.data.vendas
    }
  },
  mounted() {
    this.carregarVendedores()
  }
}
</script>
