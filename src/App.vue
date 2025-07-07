<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import { onMounted, onUnmounted } from 'vue'

// Función para actualizar dinámicamente la altura de las secciones
function updateSectionHeights() {
  const navbar = document.querySelector('nav'); // Asumiendo que el navbar está en una etiqueta 'nav'
  if (navbar) {
    const navHeight = navbar.offsetHeight;
    document.documentElement.style.setProperty('--nav-height', `${navHeight}px`);
  }
}

// Referencia para el intervalo de animación
let pulseInterval = null;

onMounted(() => {
  // Actualizar altura al cargar
  updateSectionHeights();

  // Actualizar altura cuando cambia el tamaño de la ventana
  window.addEventListener('resize', updateSectionHeights);

  // Agregar animate.css si no está incluido
  if (!document.querySelector('link[href*="animate.css"]')) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
    document.head.appendChild(link);
  }

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
  }, 2000); // Esperar 2 segundos antes de iniciar el pulso
});

onUnmounted(() => {
  // Limpieza de event listeners
  window.removeEventListener('resize', updateSectionHeights);

  // Limpiar el intervalo de pulso
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
/* Estilo global para compensar el navbar fijo */
:root {
  --nav-height: 110px;
  /* Valor inicial que será sobrescrito por JS */
}

/* Eliminamos el padding-top del body */
body {
  margin: 0;
  padding: 0;
  overflow-x: hidden; /* Prevenir scroll horizontal global */
}

/* Agregar overflow-x: hidden al app también */
#app {
  overflow-x: hidden;
  width: 100%;
  max-width: 100vw;
  min-height: 100vh;
}

/* Eliminar el margen negativo, ya no es necesario */
#inicio {
  margin-top: 0;
}

@media (max-width: 991.98px) {
  :root {
    --nav-height: 80px;
    /* Valor inicial para pantallas pequeñas */
  }
}
</style>

<style scoped>
.section {
  min-height: calc(100vh - var(--nav-height));
  /* Utiliza la variable CSS */
  scroll-margin-top: var(--nav-height);
}

#inicio {
  padding: 0;
  height: calc(100vh - var(--nav-height));
  /* Utiliza la variable CSS */
}

#porque-elegirnos,
#servicios,
#contacto {
  padding: 80px 0;
  /* Mantiene el padding original para las demás secciones */
}

/* Estilo específico para la sección entregamos */
#entregamos {
  padding: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.section h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  color: #333;
}

.section p {
  font-size: 1.2rem;
  color: #666;
  line-height: 1.6;
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
  animation-duration: 1s;
  animation-delay: 1s;
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

/* Responsive */
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
