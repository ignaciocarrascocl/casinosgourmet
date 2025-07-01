<template>
    <section ref="elegirnosRef" class="elegirnos-section" :class="{
        'animate__animated animate__fadeIn': isVisible
    }" aria-labelledby="elegirnos-heading">
        <div class="container">
            <h2 id="elegirnos-heading" class="title" :class="{
                'animate__animated animate__fadeInDown': isVisible
            }" :style="{ animationDelay: '0.2s' }">¿POR QUÉ ELEGIRNOS?</h2>

            <div class="grid" role="list">
                <!-- Seguridad alimentaria -->
                <article ref="seguridadRef" class="item" role="listitem" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '0.4s' }" 
                        itemscope itemtype="https://schema.org/Service">
                    <div class="icon-container">
                        <img :src="items.seguridad.currentImage" alt="Icono de seguridad alimentaria - protocolos sanitarios" class="icon" width="125" height="125" loading="lazy" data-icon="seguridad">
                    </div>
                    <div class="content">
                        <h3 itemprop="name">SEGURIDAD ALIMENTARIA</h3>
                        <p itemprop="description">Cumplimos con estándares de inocuidad y protocolos sanitarios de alimentos para garantizar la máxima seguridad en todos nuestros servicios.</p>
                    </div>
                </article>

                <!-- Flexibilidad -->
                <article ref="flexibilidadRef" class="item" role="listitem" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '0.6s' }"
                        itemscope itemtype="https://schema.org/Service">
                    <div class="icon-container">
                        <img :src="items.flexibilidad.currentImage" alt="Icono de flexibilidad - menús personalizados" class="icon" width="125" height="125" loading="lazy" data-icon="flexibilidad">
                    </div>
                    <div class="content">
                        <h3 itemprop="name">FLEXIBILIDAD</h3>
                        <p itemprop="description">Diseñamos menús a la medida para empresas, eventos, dietas especiales o requerimientos religiosos y culturales, adaptándonos a sus necesidades específicas.</p>
                    </div>
                </article>

                <!-- Variedad -->
                <article ref="variedadRef" class="item" role="listitem" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '0.8s' }"
                        itemscope itemtype="https://schema.org/Service">
                    <div class="icon-container">
                        <img :src="items.variedad.currentImage" alt="Icono de variedad gastronómica - múltiples opciones" class="icon" width="125" height="125" loading="lazy" data-icon="variedad">
                    </div>
                    <div class="content">
                        <h3 itemprop="name">VARIEDAD GASTRONÓMICA</h3>
                        <p itemprop="description">Ofrecemos múltiples alternativas de platos para satisfacer todos los gustos y preferencias alimentarias de su equipo.</p>
                    </div>
                </article>

                <!-- Equipamiento -->
                <article ref="equipamientoRef" class="item" role="listitem" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.0s' }"
                        itemscope itemtype="https://schema.org/Service">
                    <div class="icon-container">
                        <img :src="items.equipamiento.currentImage" alt="Icono de equipamiento profesional sin costo" class="icon" width="125" height="125" loading="lazy" data-icon="equipamiento">
                    </div>
                    <div class="content">
                        <h3 itemprop="name">EQUIPAMIENTO SIN COSTO</h3>
                        <p itemprop="description">Nos hacemos cargo de la implementación completa del mobiliario y equipos profesionales para un óptimo funcionamiento del servicio in situ, sin costo adicional.</p>
                    </div>
                </article>

                <!-- Preparaciones -->
                <article ref="preparacionesRef" class="item" role="listitem" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.2s' }"
                        itemscope itemtype="https://schema.org/Service">
                    <div class="icon-container">
                        <img :src="items.preparaciones.currentImage" alt="Icono de preparaciones caseras y frescas" class="icon" width="125" height="125" loading="lazy" data-icon="preparaciones">
                    </div>
                    <div class="content">
                        <h3 itemprop="name">PREPARACIONES CASERAS Y FRESCAS</h3>
                        <p itemprop="description">Nuestro menú está diseñado por expertos profesionales de alimentación, combinando ingredientes frescos y sabores equilibrados de buen gusto casero.</p>
                    </div>
                </article>

                <!-- Puntualidad -->
                <article ref="puntualidadRef" class="item" role="listitem" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.4s' }"
                        itemscope itemtype="https://schema.org/Service">
                    <div class="icon-container">
                        <img :src="items.puntualidad.currentImage" alt="Icono de puntualidad garantizada" class="icon" width="125" height="125" loading="lazy" data-icon="puntualidad">
                    </div>
                    <div class="content">
                        <h3 itemprop="name">PUNTUALIDAD GARANTIZADA</h3>
                        <p itemprop="description">Entregamos el servicio siempre en tiempo y forma. La puntualidad no es un valor agregado, es nuestro compromiso inquebrantable con cada cliente.</p>
                    </div>
                </article>

                <!-- Proveedores Certificados -->
                <article ref="proveedoresRef" class="item full-width" role="listitem" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.6s' }"
                        itemscope itemtype="https://schema.org/Service">
                    <div class="icon-container">
                        <img :src="items.proveedores.currentImage" alt="Icono de proveedores certificados de calidad" class="icon" width="125" height="125" loading="lazy" data-icon="proveedores">
                    </div>
                    <div class="content">
                        <h3 itemprop="name">PROVEEDORES CERTIFICADOS</h3>
                        <p itemprop="description">Trabajamos exclusivamente con proveedores de materias primas certificados y con excelente logística de distribución para garantizar materias primas frescas en todo momento.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>

<script>
import { ref, reactive } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

export default {
    name: 'ElegirnosContent',
    setup() {
        const elegirnosRef = ref(null)
        const seguridadRef = ref(null)
        const flexibilidadRef = ref(null)
        const variedadRef = ref(null)
        const equipamientoRef = ref(null)
        const preparacionesRef = ref(null)
        const puntualidadRef = ref(null)
        const proveedoresRef = ref(null)
        const isVisible = ref(false)

        const items = reactive({
            seguridad: {
                active: '/images/elegirnos/seguridad_activo.webp',
                inactive: '/images/elegirnos/seguridad_inactivo.webp',
                currentImage: '/images/elegirnos/seguridad_inactivo.webp'
            },
            flexibilidad: {
                active: '/images/elegirnos/flexibilidad_activo.webp',
                inactive: '/images/elegirnos/flexibilidad_inactivo.webp',
                currentImage: '/images/elegirnos/flexibilidad_inactivo.webp'
            },
            variedad: {
                active: '/images/elegirnos/variedad_activo.webp',
                inactive: '/images/elegirnos/variedad_inactivo.webp',
                currentImage: '/images/elegirnos/variedad_inactivo.webp'
            },
            equipamiento: {
                active: '/images/elegirnos/equipamiento_activo.webp',
                inactive: '/images/elegirnos/equipamiento_inactivo.webp',
                currentImage: '/images/elegirnos/equipamiento_inactivo.webp'
            },
            preparaciones: {
                active: '/images/elegirnos/preparaciones_activo.webp',
                inactive: '/images/elegirnos/preparaciones_inactivo.webp',
                currentImage: '/images/elegirnos/preparaciones_inactivo.webp'
            },
            puntualidad: {
                active: '/images/elegirnos/puntualidad_activo.webp',
                inactive: '/images/elegirnos/puntualidad_inactivo.webp',
                currentImage: '/images/elegirnos/puntualidad_inactivo.webp'
            },
            proveedores: {
                active: '/images/elegirnos/proveedores_activo.webp',
                inactive: '/images/elegirnos/proveedores_inactivo.webp',
                currentImage: '/images/elegirnos/proveedores_inactivo.webp'
            }
        })

        const activateIcon = (itemName) => {
            setTimeout(() => {
                // Crear efecto de desvanecimiento suave
                const item = items[itemName]
                
                // Primero reducir opacidad
                const iconElement = document.querySelector(`[data-icon="${itemName}"]`)
                if (iconElement) {
                    iconElement.style.opacity = '0'
                    
                    // Después de la transición, cambiar imagen y restaurar opacidad
                    setTimeout(() => {
                        item.currentImage = item.active
                        iconElement.style.opacity = '1'
                    }, 200)
                } else {
                    // Fallback si no encuentra el elemento
                    item.currentImage = item.active
                }
            }, 500)
        }

        // Observer para la sección principal
        useIntersectionObserver(
            elegirnosRef,
            ([{ isIntersecting }]) => {
                if (isIntersecting) {
                    isVisible.value = true
                }
            },
            {
                threshold: 0.01,
                rootMargin: '100px'
            }
        )

        // Observers individuales para cada item
        useIntersectionObserver(seguridadRef, ([{ isIntersecting }]) => {
            if (isIntersecting) activateIcon('seguridad')
        }, { threshold: 0.3 })

        useIntersectionObserver(flexibilidadRef, ([{ isIntersecting }]) => {
            if (isIntersecting) activateIcon('flexibilidad')
        }, { threshold: 0.3 })

        useIntersectionObserver(variedadRef, ([{ isIntersecting }]) => {
            if (isIntersecting) activateIcon('variedad')
        }, { threshold: 0.3 })

        useIntersectionObserver(equipamientoRef, ([{ isIntersecting }]) => {
            if (isIntersecting) activateIcon('equipamiento')
        }, { threshold: 0.3 })

        useIntersectionObserver(preparacionesRef, ([{ isIntersecting }]) => {
            if (isIntersecting) activateIcon('preparaciones')
        }, { threshold: 0.3 })

        useIntersectionObserver(puntualidadRef, ([{ isIntersecting }]) => {
            if (isIntersecting) activateIcon('puntualidad')
        }, { threshold: 0.3 })

        useIntersectionObserver(proveedoresRef, ([{ isIntersecting }]) => {
            if (isIntersecting) activateIcon('proveedores')
        }, { threshold: 0.3 })

        return {
            elegirnosRef,
            seguridadRef,
            flexibilidadRef,
            variedadRef,
            equipamientoRef,
            preparacionesRef,
            puntualidadRef,
            proveedoresRef,
            isVisible,
            items
        }
    }
}
</script>

<style scoped>
.elegirnos-section {
    padding: 4rem 0;
}

/* Estados iniciales para animaciones */
.title,
.item {
    opacity: 0;
}

.title.animate__animated,
.item.animate__animated {
    opacity: 1;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 60px;
    /* Aumentamos el padding para dar espacio a los iconos */
}

.title {
    font-size: 3rem;
    text-align: center;
    color: #bf2e1b;
    margin-bottom: 3rem;
    font-weight: 700;
    text-transform: uppercase;
}

.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

/* Estilo para las cajas con índice impar (1, 3, 5) */
.item:nth-child(odd) .icon-container {
    left: -62.5px;
    right: auto;
}

.item:nth-child(odd) .content {
    padding-left: 75px;
    padding-right: 0;
}

/* Estilo para las cajas con índice par (2, 4, 6) */
.item:nth-child(even) .icon-container {
    right: -62.5px;
    left: auto;
}

.item:nth-child(even) .content {
    padding-right: 75px;
    padding-left: 1.5rem;
    text-align: right;
}

.item {
    display: flex;
    flex-direction: row;
    width: 100%;
    margin: 0 auto;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.item:hover {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.full-width {
    grid-column: span 2;
    width: 100%;
}

.icon-container {
    position: absolute;
    left: -62.5px;
    top: 50%;
    transform: translateY(-50%);
    width: 125px;
    height: 125px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: transparent;
    border-radius: 50%;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.icon {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: all 0.4s ease, opacity 0.2s ease;
    opacity: 1;
}

.item:hover .icon-container {
    transform: translateY(-50%) scale(1.1);
}

.item:nth-child(even):hover .icon-container {
    transform: translateY(-50%) scale(1.1);
}

.item:hover .icon {
    filter: brightness(1.1);
    transform: scale(1.05);
}

.content {
    flex: 1;
    padding-left: 85px;
    text-align: left;
}

h3 {
    margin-top: 0;
    margin-bottom: 0.8rem;
    font-weight: bold;
    color: #333;
    font-size: 1.4rem;
}

p {
    margin: 0;
    color: #666;
    line-height: 1.6;
    font-size: 1rem;
}

@media (max-width: 768px) {
    .container {
        padding: 0 20px; /* Reducido de 60px a 20px */
    }

    .grid {
        grid-template-columns: 1fr;
        padding: 0 20px; /* Reducido de 50px a 20px para dar espacio a los iconos */
        gap: 4rem; /* Aumentado de 2rem a 4rem para más separación vertical */
    }

    .full-width {
        grid-column: span 1;
    }

    .item {
        width: 100%;
        padding-top: 3rem; /* Aumentado para dar espacio al icono arriba */
        overflow: visible; /* Cambiado a visible para mostrar iconos arriba */
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    /* En móvil, poner todos los iconos arriba */
    .item .icon-container,
    .item:nth-child(even) .icon-container,
    .item:nth-child(odd) .icon-container {
        position: absolute;
        left: 50%;
        right: auto;
        top: -40px; /* Posicionar arriba de la caja */
        transform: translateX(-50%);
        width: 80px;
        height: 80px;
    }

    .item:hover .icon-container,
    .item:nth-child(even):hover .icon-container,
    .item:nth-child(odd):hover .icon-container {
        transform: translateX(-50%) scale(1.1);
    }

    .item .content,
    .item:nth-child(even) .content,
    .item:nth-child(odd) .content {
        padding-left: 0;
        padding-right: 0;
        padding-top: 1rem; /* Espacio desde el icono */
        text-align: center;
    }
}

/* Agregar media query adicional para pantallas muy pequeñas como Galaxy S8 */
@media (max-width: 400px) {
    .container {
        padding: 0 15px;
    }

    .grid {
        padding: 0 15px;
        gap: 3rem; /* Separación reducida pero aún mayor que desktop */
    }

    .item .icon-container,
    .item:nth-child(even) .icon-container,
    .item:nth-child(odd) .icon-container {
        top: -30px;
        width: 60px;
        height: 60px;
        transform: translateX(-50%);
    }

    .item .content,
    .item:nth-child(even) .content,
    .item:nth-child(odd) .content {
        padding-left: 0;
        padding-right: 0;
        padding-top: 0.5rem;
    }

    .title {
        font-size: 2.5rem;
    }

    h3 {
        font-size: 1.2rem;
    }

    p {
        font-size: 0.9rem;
    }
}
</style>
