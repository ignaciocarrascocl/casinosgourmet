<template>
    <section ref="elegirnosRef" class="elegirnos-section" :class="{
        'animate__animated animate__fadeIn': isVisible
    }">
        <div class="container">
            <h1 class="title" :class="{
                'animate__animated animate__fadeInDown': isVisible
            }" :style="{ animationDelay: '0.2s' }">¿POR QUÉ ELEGIRNOS?</h1>

            <div class="grid">
                <!-- Seguridad alimentaria -->
                <div class="item" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '0.4s' }">
                    <div class="icon-container" @mouseover="hoverItem('seguridad')"
                        @mouseleave="unhoverItem('seguridad')">
                        <img :src="items.seguridad.currentImage" alt="Seguridad alimentaria" class="icon">
                    </div>
                    <div class="content">
                        <h3>SEGURIDAD ALIMENTARIA</h3>
                        <p>Cumplimos con estándares de inocuidad y protocolos sanitarios de alimentos.</p>
                    </div>
                </div>

                <!-- Flexibilidad -->
                <div class="item" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '0.6s' }">
                    <div class="icon-container" @mouseover="hoverItem('flexibilidad')"
                        @mouseleave="unhoverItem('flexibilidad')">
                        <img :src="items.flexibilidad.currentImage" alt="Flexibilidad" class="icon">
                    </div>
                    <div class="content">
                        <h3>FLEXIBILIDAD</h3>
                        <p>Diseñamos menús a la medida para empresas, eventos, dietas especiales o requerimientos
                            religiosos y culturales.</p>
                    </div>
                </div>

                <!-- Variedad -->
                <div class="item" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '0.8s' }">
                    <div class="icon-container" @mouseover="hoverItem('variedad')"
                        @mouseleave="unhoverItem('variedad')">
                        <img :src="items.variedad.currentImage" alt="Variedad" class="icon">
                    </div>
                    <div class="content">
                        <h3>VARIEDAD</h3>
                        <p>Ofrecemos múltiples alternativas de platos.</p>
                    </div>
                </div>

                <!-- Equipamiento -->
                <div class="item" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.0s' }">
                    <div class="icon-container" @mouseover="hoverItem('equipamiento')"
                        @mouseleave="unhoverItem('equipamiento')">
                        <img :src="items.equipamiento.currentImage" alt="Equipamiento" class="icon">
                    </div>
                    <div class="content">
                        <h3>EQUIPAMIENTO SIN COSTO</h3>
                        <p>Nos hacemos cargo de la implementación completa del mobiliario y equipos para un óptimo
                            funcionamiento del servicio in situ.</p>
                    </div>
                </div>

                <!-- Preparaciones -->
                <div class="item" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.2s' }">
                    <div class="icon-container" @mouseover="hoverItem('preparaciones')"
                        @mouseleave="unhoverItem('preparaciones')">
                        <img :src="items.preparaciones.currentImage" alt="Preparaciones" class="icon">
                    </div>
                    <div class="content">
                        <h3>PREPARACIONES CASERAS Y FRESCAS</h3>
                        <p>Nuestro menú está diseñado por expertos profesionales de alimentación, combinando
                            ingredientes frescos y sabores equilibrados y de buen gusto.</p>
                    </div>
                </div>

                <!-- Puntualidad -->
                <div class="item" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.4s' }">
                    <div class="icon-container" @mouseover="hoverItem('puntualidad')"
                        @mouseleave="unhoverItem('puntualidad')">
                        <img :src="items.puntualidad.currentImage" alt="Puntualidad" class="icon">
                    </div>
                    <div class="content">
                        <h3>PUNTUALIDAD</h3>
                        <p>Entregamos el servicio siempre en tiempo y forma. La puntualidad no es un valor agregado, es
                            un compromiso.</p>
                    </div>
                </div>

                <!-- Proveedores Certificados -->
                <div class="item full-width" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.6s' }">
                    <div class="icon-container" @mouseover="hoverItem('proveedores')"
                        @mouseleave="unhoverItem('proveedores')">
                        <img :src="items.proveedores.currentImage" alt="Proveedores Certificados" class="icon">
                    </div>
                    <div class="content">
                        <h3>PROVEEDORES CERTIFICADOS</h3>
                        <p>Trabajamos con proveedores de materias primas certificados y con excelente logística de
                            distribución a fin de tener materias primas frescas en todo momento.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { ref } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

export default {
    name: 'ElegirnosContent',
    setup() {
        const elegirnosRef = ref(null)
        const isVisible = ref(false)

        useIntersectionObserver(
            elegirnosRef,
            ([{ isIntersecting }]) => {
                if (isIntersecting) {
                    isVisible.value = true
                }
            },
            {
                threshold: 0.1,
                rootMargin: '50px'
            }
        )

        return {
            elegirnosRef,
            isVisible
        }
    },
    data() {
        return {
            items: {
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
            }
        }
    },
    methods: {
        hoverItem(item) {
            this.items[item].currentImage = this.items[item].active;
        },
        unhoverItem(item) {
            this.items[item].currentImage = this.items[item].inactive;
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
}

.icon {
    width: 100%;
    height: 100%;
    object-fit: contain;
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
    .grid {
        grid-template-columns: 1fr;
        padding: 0 50px;
        /* Espacio para los iconos a los lados */
    }

    .full-width {
        grid-column: span 1;
    }

    .item {
        width: 100%;
        padding-top: 1.5rem;
    }

    /* En móvil, poner todos los iconos a la izquierda */
    .item .icon-container,
    .item:nth-child(even) .icon-container,
    .item:nth-child(odd) .icon-container {
        left: -62.5px;
        right: auto;
        top: 50%;
        transform: translateY(-50%);
    }

    .item .content,
    .item:nth-child(even) .content,
    .item:nth-child(odd) .content {
        padding-left: 60px;
        padding-right: 0;
        text-align: left;
    }
}
</style>
