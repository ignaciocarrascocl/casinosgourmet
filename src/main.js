import 'bootstrap/dist/css/bootstrap.css'
import 'animate.css'
import './assets/variables.css'
import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(router)

app.mount('#app')
