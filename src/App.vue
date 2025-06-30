<script setup>
import Navbar from './components/Navbar.vue'
import HomeContent from './components/HomeContent.vue'
import ElegirnosContent from './components/ElegirnosContent.vue'
import EntregamosContent from './components/EntregamosContent.vue'
import ServiciosContent from './components/ServiciosContent.vue'
import ContactoContent from './components/ContactoContent.vue'
import Footer from './components/Footer.vue'
import { onMounted, onUnmounted } from 'vue'

// Función para actualizar dinámicamente la altura de las secciones
function updateSectionHeights() {
  const navbar = document.querySelector('nav'); // Asumiendo que el navbar está en una etiqueta 'nav'
  if (navbar) {
    const navHeight = navbar.offsetHeight;
    document.documentElement.style.setProperty('--nav-height', `${navHeight}px`);

    // También actualizamos el padding-top del body
    document.body.style.paddingTop = `${navHeight}px`;
  }
}

onMounted(() => {
  // Actualizar altura al cargar
  updateSectionHeights();

  // Actualizar altura cuando cambia el tamaño de la ventana
  window.addEventListener('resize', updateSectionHeights);
});

onUnmounted(() => {
  // Limpieza de event listeners
  window.removeEventListener('resize', updateSectionHeights);
});
</script>

<template>
  <Navbar />

  <!-- Sección Inicio -->
  <section id="inicio" class="section">
    <HomeContent />
  </section>

  <!-- Sección ¿Por qué elegirnos? -->
  <section id="porque-elegirnos" class="section">
    <ElegirnosContent />
  </section>

  <!-- Sección Lo que entregamos -->
  <section id="entregamos" class="section">
    <EntregamosContent />
  </section>

  <!-- Sección Servicios -->
  <section id="servicios" class="section">
    <ServiciosContent />
  </section>

  <!-- Sección Contacto -->
  <section id="contacto" class="section">
    <ContactoContent />
  </section>

  <!-- Footer -->
  <Footer />
</template>

<style>
/* Estilo global para compensar el navbar fijo */
:root {
  --nav-height: 110px;
  /* Valor inicial que será sobrescrito por JS */
}

body {
  padding-top: var(--nav-height);
  /* Usa la variable CSS en lugar de un valor fijo */
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
</style>
