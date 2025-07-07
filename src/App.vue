<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import { onMounted, onUnmounted } from 'vue'

let pulseInterval = null;

onMounted(() => {
  // Configurar animación de pulso cada 5 segundos
  setTimeout(() => {
    pulseInterval = setInterval(() => {
      const whatsappButton = document.querySelector('.whatsapp-button');
      if (whatsappButton) {
        whatsappButton.classList.add('animate__pulse');
        setTimeout(() => {
          whatsappButton.classList.remove('animate__pulse');
        }, 1000);
      }
    }, 5000);
  }, 2000);
});

onUnmounted(() => {
  if (pulseInterval) {
    clearInterval(pulseInterval);
  }
});
</script>

<template>
  <Navbar />
  
  <!-- Router view para mostrar las diferentes páginas -->
  <router-view />

  <!-- Footer -->
  <Footer />

  <!-- Botón WhatsApp fijo -->
  <a href="https://wa.me/56944622619?text=Hola,%20me%20interesa%20conocer%20más%20sobre%20sus%20servicios%20de%20casino%20gourmet"
    target="_blank" class="whatsapp-button animate__animated animate__bounceIn animate__delay-1s"
    aria-label="Contactar por WhatsApp">
    <img src="/images/icons/whatsapp.png" alt="WhatsApp" />
  </a>
</template>

<style>
/* Variables CSS fijas - sin cálculos dinámicos */
:root {
  --nav-height: 110px;
}

body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

#app {
  overflow-x: hidden;
  width: 100%;
  max-width: 100vw;
}

/* iOS specific fixes */
@supports (-webkit-touch-callout: none) {
  html {
    height: 100%;
    overflow: hidden;
  }
  
  body {
    height: 100%;
    overflow: hidden;
    position: relative;
  }
  
  #app {
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    position: relative;
  }
}

@media (max-width: 991.98px) {
  :root {
    --nav-height: 80px;
  }
}
</style>

<style scoped>
/* Estilo simple para secciones */
.section {
  scroll-margin-top: var(--nav-height);
}

/* Estilos del botón WhatsApp */
.whatsapp-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 60px;
  height: 60px;
  background-color: #25d366;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  z-index: 1000;
  transition: all 0.3s ease;
}

.whatsapp-button:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
  background-color: #128c7e;
}

.whatsapp-button img {
  width: 35px;
  height: 35px;
  filter: brightness(0) invert(1);
}

@media (max-width: 768px) {
  .whatsapp-button {
    width: 55px;
    height: 55px;
    bottom: 15px;
    right: 15px;
  }

  .whatsapp-button img {
    width: 30px;
    height: 30px;
  }
}
</style>
