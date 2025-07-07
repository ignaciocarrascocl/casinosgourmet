<template>
  <div class="home-view">
    <!-- Sección Inicio -->
    <section id="inicio" class="section">
      <HomeContent />
    </section>

    <!-- Sección Por qué elegirnos -->
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
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'
import { useSEO, seoConfigs } from '@/composables/useSEO.js'
import HomeContent from '@/components/HomeContent.vue'
import ElegirnosContent from '@/components/ElegirnosContent.vue'
import EntregamosContent from '@/components/EntregamosContent.vue'
import ServiciosContent from '@/components/ServiciosContent.vue'
import ContactoContent from '@/components/ContactoContent.vue'

const { setPageSEO, resetSEO, addBreadcrumbStructuredData } = useSEO()

onMounted(() => {
  // Configurar SEO para la página principal
  setPageSEO(seoConfigs.home)
  
  // Agregar breadcrumbs para la página principal
  addBreadcrumbStructuredData([
    { name: 'Inicio', url: 'https://casinosgourmet.cl' }
  ])
})

onUnmounted(() => {
  resetSEO()
})
</script>

<style scoped>
.home-view {
  padding-top: 110px;
}

.section {
  scroll-margin-top: 110px;
}

#inicio {
  padding: 0;
  min-height: 600px; /* Cambiar de calc(100vh - 110px) a altura fija */
}

#porque-elegirnos,
#servicios,
#contacto {
  padding: 80px 0;
}

#entregamos {
  padding: 0;
}

@media (max-width: 991.98px) {
  .home-view {
    padding-top: 80px;
  }
  
  .section {
    scroll-margin-top: 80px;
  }
  
  #inicio {
    min-height: 500px; /* Cambiar de calc(100vh - 80px) a altura fija */
    height: auto;
  }
}
</style>
