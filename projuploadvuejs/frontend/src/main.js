import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'


//Enviando configurações defaults para o axios
//axios.defaults.baseURL = '' //base url da api
//axios.defaults.headers.common.test = 'application/json '//mudar contenttype ver como usar

//interceptar todas as requisicoes e enviar o token de autorizacao para validar login por exemplo
axios.interceptors.request.use(function(config){
    config.headers.Authorization = 'Bearer Token API'
    return config
})


//Criacao para informar os componentes globais
const app = createApp(App)
app.config.globalProperties.$axios = axios
app.mount('#app')
