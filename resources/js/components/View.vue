<template>
    <div>
        <div class="mb-3">
            <label for="desc" class="form-label">Descrição</label>
            <textarea :disabled="readonly" v-model="descDespesa" id="desc" class="form-control" name="" cols="30" rows="5"></textarea>
            <div id="descricao" class="form-text">Descrição da Despesa</div>
        </div>
        <div class="mb-3">
            <label for="Valor" class="form-label">Valor</label>
            <input :disabled="readonly" @change="formataValor" :value="despesa.valor" type="text" class="form-control" id="Valor">
            <div id="vlDespesa" class="form-text">Valor da Despesa</div>
        </div>
        <div class="mb-3 row">
            <div class="col-5">
                <label class="form-check-label" for="data">Data</label>
                <input :disabled="readonly" type="date" v-model="dtDespesa" class="form-control input-sm" id="data">
                <div id="vlDespesa" class="form-text">Data de ocorrência da Despesa</div>
            </div>
            
        </div>
        <button v-if="!readonly" @click="edit" class="btn btn-primary">Cadastrar</button>
    </div>
</template>

<script>
export default {
    data(){
        return{
            descDespesa:'',
            vlDespesa:'',
            despesa:{},
            data:'',
            valor:0,
            desc:'',
            readonly:true
        }
    },
     methods:{
        async show(){
            var options = {
                Headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf
                },
                method:'GET'
            }

            let despesas = await fetch(`despesas/${this.$route.query.desp}`,options)
            if(despesas.status == 403){
                window.location.href = '#/'
            }

            despesas = await despesas.json();
            
            this.despesa = despesas
            this.descDespesa= despesas.desc,
            this.vlDespesa=despesas.valor,
            this.dtDespesa=despesas.data_datetime

        },
        async edit(){
            
            let body= {
                    desc:this.descDespesa,
                    valor:this.vlDespesa,
                    date:this.dtDespesa
                };
            let headers={
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf
                };
            let result = await axios.put(`despesas/${this.despesa.id}`, body, { headers })
            console.log(result)

            if (result.status ==200) {
                window.location.href = '#/'
            }
        },
        async formataValor(e){
            var formatter= new Intl.NumberFormat('pt-BR',{style:"currency",currency:"BRL"})
            let element = e.target;

            element.value = parseFloat(element.value.replace('R$','').replace('.','').replace(',','.'))
            this.vlDespesa = element.value; 
            return element.value = formatter.format(element.value);
        }
     },
     mounted(){
        console.log(this.$route);

        if (this.$route.path =='/view') {
            this.readonly = true;
        } else {
            this.readonly = false;
        }
        this.show()
     }
}
</script>

<style>

</style>