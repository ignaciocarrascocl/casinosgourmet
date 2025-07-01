<template>
  <div class="trabaja-view">
    <TrabajaConNosotrosContent />
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'
import { useSEO, seoConfigs } from '@/composables/useSEO.js'
import TrabajaConNosotrosContent from '@/components/TrabajaConNosotrosContent.vue'

const { setPageSEO, resetSEO, addBreadcrumbStructuredData, addServiceStructuredData } = useSEO()

onMounted(() => {
  // Configurar SEO para la página de trabajo
  setPageSEO(seoConfigs['trabaja-con-nosotros'])
  
  // Agregar breadcrumbs
  addBreadcrumbStructuredData([
    { name: 'Inicio', url: 'https://casinosgourmet.cl' },
    { name: 'Trabaja con Nosotros', url: 'https://casinosgourmet.cl/trabaja-con-nosotros' }
  ])

  // Agregar structured data específico para oportunidades laborales
  const jobPostingData = {
    "@context": "https://schema.org",
    "@type": "JobPosting",
    "title": "Oportunidades Laborales en Alimentación Empresarial",
    "description": "Únete al equipo de Casinos Gourmet. Buscamos auxiliares de cocina, ayudantes y maestros cocineros para servicios de alimentación empresarial.",
    "hiringOrganization": {
      "@type": "Organization",
      "name": "Casinos Gourmet",
      "sameAs": "https://casinosgourmet.cl"
    },
    "jobLocation": {
      "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "CL"
      }
    },
    "employmentType": ["FULL_TIME", "PART_TIME"],
    "industry": "Servicios de Alimentación",
    "occupationalCategory": "Servicios de Alimentación y Cocina"
  }

  // Agregar el structured data de trabajo
  const existingJob = document.querySelector('script[type="application/ld+json"]#job-data')
  if (existingJob) {
    existingJob.remove()
  }

  const script = document.createElement('script')
  script.type = 'application/ld+json'
  script.id = 'job-data'
  script.textContent = JSON.stringify(jobPostingData)
  document.head.appendChild(script)
})

onUnmounted(() => {
  resetSEO()
  
  // Limpiar job posting data
  const jobScript = document.querySelector('script[type="application/ld+json"]#job-data')
  if (jobScript) {
    jobScript.remove()
  }
})
</script>

<style scoped>
.trabaja-view {
  padding-top: var(--nav-height, 110px);
  min-height: 100vh;
}

@media (max-width: 991.98px) {
  .trabaja-view {
    padding-top: var(--nav-height, 80px);
  }
}
</style>