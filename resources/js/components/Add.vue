<template>
  <form @submit.prevent="cadastrar" action="" method="post">
        <div class="mb-3">
            <label for="desc" class="form-label">Descrição</label>
            <textarea v-model="descDespesa" type="text" class="form-control" id="desc" aria-describedby="descricao"></textarea>
            <div id="descricao" class="form-text">Descrição da Despesa</div>
        </div>
        <div class="mb-3">
            <label for="Valor" class="form-label">Valor</label>
            <input @change="formataValor" type="text" class="form-control" id="Valor">
            <div id="vlDespesa" class="form-text">Valor da Despesa</div>
        </div>
        <div class="mb-3 row">
            <div class="col-5">
                <label class="form-check-label" for="data">Data</label>
                <input type="date" v-model="dtDespesa" class="form-control input-sm" id="data">
                <div id="vlDespesa" class="form-text">Data de ocorrência da Despesa</div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</template>

<script>
export default {
    data(){
        return{
            descDespesa:'',
            vlDespesa:''
        }
    },
     methods:{
        async cadastrar(e){
            
            let body= {
                    desc:this.descDespesa,
                    valor:this.vlDespesa,
                    date:this.dtDespesa
                };
            let headers={
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf
                };
            let result = await axios.post('despesas', body, { headers })
            console.log(result)

            if (result.status ==200) {
                window.location.href = '#/'
            }
        },
        async formataValor(e){
            var formatter= new Intl.NumberFormat('pt-BR',{style:"currency",currency:"BRL"})
            console.log(e)
            let element = e.target;

            element.value = parseFloat(element.value.replace('R$','').replace('.','').replace(',','.'))
            this.vlDespesa = element.value; 
            return element.value = formatter.format(element.value);
        }
     }
}
</script>

<style>

</style>