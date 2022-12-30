<template>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Responsável</th>
      <th scope="col">Data</th>
      <th scope="col">Valor</th>
      <th scope="col">Descricão</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody v-for="despesa in despesas">
    <tr>
      <th scope="row">{{despesa.id}}</th>
      <td>{{despesa.user.name}}</td>
      <td>{{despesa.data}}</td>
      <td>{{despesa.valor}}</td>
      <td>{{despesa.short_desc}}</td>
      <td>        
        <button @click="deletar" class="btn btn-danger">
            <i class="bi bi-x-square"></i>
        </button>          
        <button @click="edit(despesa.id)" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i>
        </button> 
        <button @click="visualizar(despesa.id)" class="btn btn-primary">
            <i class="bi bi-eye-fill"></i>
        </button> 
      </td>
    </tr>
  </tbody>
</table>
</template>

<script>
export default {
    name:'List',
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            despesas:[]
        }
    },
    methods:{
        async getDespesas(){
            var options = {
                Headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf
                },
                method:'GET'
            }
            let despesas = await fetch('despesas',options)
            despesas = await despesas.json()
            
            this.despesas = despesas.data
        },
        visualizar(id){
          console.log(id)
          window.location.href= `#/view?desp=${id}`
        },
        edit(id){
          console.log(id)
          window.location.href= `#/edit?desp=${id}`
        }
    },
    mounted(){
        this.getDespesas()
    }
}
</script>

<style>

</style>