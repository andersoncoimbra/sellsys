<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Reenvio de E-mail de Comissão</h1>

    <div class="space-y-4">
      <select v-model="vendedorSelecionado" class="w-full p-2 border rounded">
        <option disabled value="">Selecione um vendedor</option>
        <option v-for="v in vendedores" :key="v.id" :value="v.id">
          {{ v.nome }} - {{ v.email }}
        </option>
      </select>

      <button
        @click="reenviarEmail"
        :disabled="!vendedorSelecionado"
        class="btn btn-primary w-full"
      >
        Reenviar E-mail de Comissão
      </button>

    <div v-if="mensagem" class="alert alert-success" role="alert">
      {{ mensagem }}
    </div>
    <div v-if="erro" class="alert alert-danger" role="alert">
      {{ erro }}
    </div>
    </div>
  </div>
</template>

<script>
import api from '../services/api'

export default {
  name: 'AdminReenvioEmail',
  data() {
    return {
      vendedores: [],
      vendedorSelecionado: '',
      mensagem: '',
      erro: ''
    }
  },
  methods: {
    async carregarVendedores() {
      const res = await api.get('/vendedores')
      this.vendedores = res.data.data
    },
    async reenviarEmail() {
      this.mensagem = ''
      this.erro = ''
      try {
        await api.post(`/reenviar-comissao/${this.vendedorSelecionado}`)
        this.mensagem = 'E-mail reenviado com sucesso.'
      } catch (err) {
        this.erro = 'Erro ao reenviar o e-mail.'
      }
    }
  },
  mounted() {
    this.carregarVendedores()
  }
}
</script>
