<template>
  <div>        
    <p>Exemplo de como enviar um arquivo usando Axios para API Laravel</p>
    <br/>
    {{barraprogresso}} % <input type="file" v-on:change="onchangeFile" />
    <br/>
    <hr/>
    <p class="sucesso" v-if="sucesso">{{sucesso}}</p>
    <p class="erro" v-if="erro">{{erro}}</p>
    <hr/>

    <img
      v-if="imgpath"
      :src="imgpath"  width="250" height="250">
    




  </div>
</template>

<script>

export default {

  data () {
    return{
      name: 'App',
      imgpath : null,
      erro : null,
      sucesso : null,
      barraprogresso : 0,
    }
  },
  
  
  methods : {
    onchangeFile($evt){
      
      const PayLoadFile = new FormData()
      PayLoadFile.append('file', $evt.target.files[0])

    //A propria biblioteca do axios tem uma funcao para fazer a barra de progresso
    this.$axios.post('http://127.0.0.1:8000/api/upload', PayLoadFile,{
      onUploadProgress: (progressEvent) => {
          //console.log(progressEvent.loaded);
          //console.log(progressEvent.total);


          //Mostra barra de progresso
          this.barraprogresso = Math.round((progressEvent.loaded * 100) / progressEvent.total)

      }},
      )
      .then((response=>{
        //console.log(response.data)
        this.erro = response.data.erro
        this.sucesso = response.data.sucesso
        this.imgpath = response.data.urlfile

      }))


    }
  }
}
</script>

<style>

.erro{
  color : red;
  font-size: 25px;
}

.sucesso{
  color : blue;
  font-size: 25px;
}



</style>
