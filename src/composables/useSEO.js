export function useSEO() {
  let originalTitle = ''
  let addedMetaTags = []

  const setPageSEO = ({ 
    title, 
    description, 
    keywords, 
    canonical, 
    ogTitle, 
    ogDescription, 
    ogImage,
    ogUrl,
    structuredData 
  }) => {
    // Guardar título original
    if (!originalTitle) {
      originalTitle = document.title
    }

    // Actualizar título
    if (title) {
      document.title = title
    }

    // Función helper para crear o actualizar meta tags
    const setMetaTag = (name, content, property = false) => {
      if (!content) return

      const attribute = property ? 'property' : 'name'
      const selector = property ? `meta[property="${name}"]` : `meta[name="${name}"]`
      
      let meta = document.querySelector(selector)
      
      if (meta) {
        meta.content = content
      } else {
        meta = document.createElement('meta')
        meta.setAttribute(attribute, name)
        meta.content = content
        document.head.appendChild(meta)
        addedMetaTags.push(meta)
      }
    }

    // Actualizar meta tags básicos
    setMetaTag('description', description)
    setMetaTag('keywords', keywords)

    // Actualizar Open Graph tags
    setMetaTag('og:title', ogTitle || title, true)
    setMetaTag('og:description', ogDescription || description, true)
    setMetaTag('og:image', ogImage, true)
    setMetaTag('og:url', ogUrl || window.location.href, true)

    // Actualizar Twitter Cards
    setMetaTag('twitter:title', ogTitle || title)
    setMetaTag('twitter:description', ogDescription || description)
    setMetaTag('twitter:image', ogImage)

    // Actualizar canonical URL
    if (canonical) {
      let canonicalLink = document.querySelector('link[rel="canonical"]')
      if (canonicalLink) {
        canonicalLink.href = canonical
      } else {
        canonicalLink = document.createElement('link')
        canonicalLink.rel = 'canonical'
        canonicalLink.href = canonical
        document.head.appendChild(canonicalLink)
        addedMetaTags.push(canonicalLink)
      }
    }

    // Actualizar structured data
    if (structuredData) {
      // Remover structured data anterior si existe
      const existingScript = document.querySelector('script[type="application/ld+json"]#page-structured-data')
      if (existingScript) {
        existingScript.remove()
      }

      // Agregar nuevo structured data
      const script = document.createElement('script')
      script.type = 'application/ld+json'
      script.id = 'page-structured-data'
      script.textContent = JSON.stringify(structuredData)
      document.head.appendChild(script)
      addedMetaTags.push(script)
    }
  }

  const resetSEO = () => {
    // Restaurar título original
    if (originalTitle) {
      document.title = originalTitle
    }

    // Remover meta tags agregados dinámicamente
    addedMetaTags.forEach(tag => {
      if (tag.parentNode) {
        tag.parentNode.removeChild(tag)
      }
    })
    addedMetaTags = []
  }

  const addBreadcrumbStructuredData = (breadcrumbs) => {
    const breadcrumbData = {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": breadcrumbs.map((crumb, index) => ({
        "@type": "ListItem",
        "position": index + 1,
        "name": crumb.name,
        "item": crumb.url
      }))
    }

    const existingBreadcrumb = document.querySelector('script[type="application/ld+json"]#breadcrumb-data')
    if (existingBreadcrumb) {
      existingBreadcrumb.remove()
    }

    const script = document.createElement('script')
    script.type = 'application/ld+json'
    script.id = 'breadcrumb-data'
    script.textContent = JSON.stringify(breadcrumbData)
    document.head.appendChild(script)
    addedMetaTags.push(script)
  }

  const addServiceStructuredData = (service) => {
    const serviceData = {
      "@context": "https://schema.org",
      "@type": "Service",
      "name": service.name,
      "description": service.description,
      "provider": {
        "@type": "Organization",
        "name": "Casinos Gourmet",
        "url": "https://casinosgourmet.cl"
      },
      "areaServed": {
        "@type": "Country",
        "name": "Chile"
      },
      "serviceType": service.type || "Servicios de Alimentación Empresarial"
    }

    if (service.image) {
      serviceData.image = service.image
    }

    const existingService = document.querySelector('script[type="application/ld+json"]#service-data')
    if (existingService) {
      existingService.remove()
    }

    const script = document.createElement('script')
    script.type = 'application/ld+json'
    script.id = 'service-data'
    script.textContent = JSON.stringify(serviceData)
    document.head.appendChild(script)
    addedMetaTags.push(script)
  }

  return {
    setPageSEO,
    resetSEO,
    addBreadcrumbStructuredData,
    addServiceStructuredData
  }
}

// Configuraciones SEO predefinidas para diferentes páginas
export const seoConfigs = {
  home: {
    title: 'Casinos Gourmet - Servicios de Alimentación Empresarial de Calidad',
    description: 'Casinos Gourmet ofrece servicios integrales de alimentación empresarial: desayunos, almuerzos, colaciones y eventos corporativos. Equipamiento profesional, puntualidad garantizada y variedad gastronómica.',
    keywords: 'casino empresarial, alimentación corporativa, servicios de catering, desayunos empresariales, almuerzos corporativos, colaciones, eventos empresariales, casinos gourmet',
    canonical: 'https://casinosgourmet.cl',
    ogImage: 'https://casinosgourmet.cl/logonavbar.webp'
  },
  
  'trabaja-con-nosotros': {
    title: 'Trabaja con Nosotros - Únete al Equipo de Casinos Gourmet',
    description: 'Únete al equipo de Casinos Gourmet. Ofrecemos oportunidades laborales para auxiliares de cocina, ayudantes y maestros cocineros. Desarrolla tu carrera en alimentación empresarial.',
    keywords: 'trabajos casino empresarial, empleos cocina, auxiliar cocina, ayudante cocina, maestro cocinero, oportunidades laborales, casinos gourmet empleos',
    canonical: 'https://casinosgourmet.cl/trabaja-con-nosotros',
    ogTitle: 'Oportunidades Laborales - Casinos Gourmet',
    ogDescription: 'Únete al equipo de Casinos Gourmet. Oportunidades para auxiliares, ayudantes y maestros cocineros.',
    ogImage: 'https://casinosgourmet.cl/images/trabajaconnosotros/header-trabaja.webp'
  },

  servicios: {
    title: 'Nuestros Servicios - Alimentación Empresarial Integral | Casinos Gourmet',
    description: 'Descubre nuestros servicios de alimentación empresarial: desayunos nutritivos, almuerzos completos, colaciones saludables y catering para eventos corporativos.',
    keywords: 'servicios alimentación empresarial, desayunos empresariales, almuerzos corporativos, colaciones empresa, eventos corporativos, catering empresarial',
    canonical: 'https://casinosgourmet.cl/servicios',
    ogTitle: 'Servicios de Alimentación Empresarial - Casinos Gourmet',
    ogImage: 'https://casinosgourmet.cl/images/servicios/almuerzos.webp'
  },

  'por-que-elegirnos': {
    title: '¿Por Qué Elegirnos? - Ventajas de Casinos Gourmet',
    description: 'Conoce las ventajas de elegir Casinos Gourmet: equipamiento de última generación, puntualidad garantizada, variedad gastronómica, proveedores de calidad y máxima seguridad alimentaria.',
    keywords: 'ventajas casino empresarial, equipamiento profesional, puntualidad, seguridad alimentaria, proveedores calidad, flexibilidad servicios',
    canonical: 'https://casinosgourmet.cl/por-que-elegirnos',
    ogTitle: 'Ventajas y Beneficios - Casinos Gourmet'
  }
}