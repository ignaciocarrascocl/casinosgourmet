<template>
    <div ref="trabajaRef" class="trabaja-container" :class="{
        'animate__animated animate__fadeIn': isVisible
    }">
        <!-- Header con imagen de fondo -->
        <div class="header-section" :class="{
            'animate__animated animate__fadeIn': isVisible
        }" :style="{ animationDelay: '0.2s' }">
            <h1 class="main-title">TRABAJA CON NOSOTROS</h1>
        </div>

        <div class="content-section">
            <!-- Subtítulo -->
            <p class="subtitle" :class="{
                'animate__animated animate__fadeInUp': isVisible
            }" :style="{ animationDelay: '0.4s' }">
                Constantemente necesitamos personal para nuevos procesos.
            </p>

            <!-- Posiciones laborales -->
            <div class="positions-grid" :class="{
                'animate__animated animate__fadeInUp': isVisible
            }" :style="{ animationDelay: '0.6s' }">
                <div class="position-item" :class="{
                    'animate__animated animate__zoomIn': isVisible
                }" :style="{ animationDelay: '0.8s' }">
                    <div class="position-icon">
                        <img src="/images/trabajaconnosotros/maestros.webp" alt="Maestros de Cocina" />
                    </div>
                    <h3>Maestros de Cocina</h3>
                </div>

                <div class="position-item" :class="{
                    'animate__animated animate__zoomIn': isVisible
                }" :style="{ animationDelay: '1.0s' }">
                    <div class="position-icon">
                        <img src="/images/trabajaconnosotros/ayudante.webp" alt="Ayudante de Cocina" />
                    </div>
                    <h3>Ayudante de Cocina</h3>
                </div>

                <div class="position-item" :class="{
                    'animate__animated animate__zoomIn': isVisible
                }" :style="{ animationDelay: '1.2s' }">
                    <div class="position-icon">
                        <img src="/images/trabajaconnosotros/auxiliares.webp" alt="Auxiliares de Casino" />
                    </div>
                    <h3>Auxiliares de Casino</h3>
                </div>
            </div>

            <!-- Información de contacto -->
            <div class="contact-info" :class="{
                'animate__animated animate__fadeInUp': isVisible
            }" :style="{ animationDelay: '1.4s' }">
                <p class="contact-text">Envía tu Cv actualizado a</p>
                <div class="email-container">
                    <a href="mailto:RRHH@CASINOSGOURMET.CL" class="email-link">
                        RRHH@CASINOSGOURMET.CL
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

const trabajaRef = ref(null)
const isVisible = ref(false)

useIntersectionObserver(
    trabajaRef,
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
</script>

<style scoped>
.trabaja-container {
    width: 100%;
    font-family: var(--font-family);
    min-height: 500px; /* Cambiar de calc(100vh - 110px) a altura fija */
}

/* Estados iniciales para animaciones */
.header-section,
.subtitle,
.positions-grid,
.position-item,
.contact-info {
    opacity: 0;
}

.header-section.animate__animated,
.subtitle.animate__animated,
.positions-grid.animate__animated,
.position-item.animate__animated,
.contact-info.animate__animated {
    opacity: 1;
}

.header-section {
    height: 400px;
    background-image: url('/images/trabajaconnosotros/header-trabaja.webp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.header-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
}

.main-title {
    font-size: 4rem;
    font-weight: bold;
    color: white;
    text-align: center;
    letter-spacing: 3px;
    position: relative;
    z-index: 1;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
}

.content-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 80px 20px 60px;
    text-align: center;
}

.subtitle {
    font-size: 1.8rem;
    color: var(--negro);
    margin-bottom: 80px;
    font-weight: 500;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.4;
}

.positions-grid {
    display: flex;
    justify-content: center;
    gap: 80px;
    margin-bottom: 100px;
    flex-wrap: wrap;
}

.position-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 250px;
}

.position-icon {
    width: 150px;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 30px;
    transition: transform 0.3s ease;
}

.position-icon:hover {
    transform: scale(1.05);
}

.position-icon img {
    width: 150px;
    height: 150px;
    object-fit: contain;
}

.position-item h3 {
    font-size: 1.3rem;
    color: var(--negro);
    font-weight: 600;
    text-align: center;
    line-height: 1.3;
}

.contact-info {
    text-align: center;
}

.contact-text {
    font-size: 1.6rem;
    color: var(--negro);
    margin-bottom: 20px;
    font-weight: 500;
}

.email-container {
    background-color: var(--rojo);
    display: inline-block;
    padding: 15px 40px;
    border-radius: 5px;
}

.email-link {
    color: white;
    text-decoration: none;
    font-size: 1.4rem;
    font-weight: bold;
    letter-spacing: 1px;
    transition: opacity 0.3s ease;
}

.email-link:hover {
    opacity: 0.9;
    color: white;
}

/* Responsive Design */
@media (max-width: 991px) {
    .main-title {
        font-size: 3rem;
    }

    .subtitle {
        font-size: 1.5rem;
        margin-bottom: 60px;
    }

    .positions-grid {
        gap: 60px;
        margin-bottom: 80px;
    }

    .position-icon {
        width: 120px;
        height: 120px;
    }

    .position-icon img {
        width: 120px;
        height: 120px;
    }

    .position-item h3 {
        font-size: 1.2rem;
    }
}

@media (max-width: 768px) {
    .header-section {
        height: 300px;
    }

    .main-title {
        font-size: 2.5rem;
        letter-spacing: 2px;
    }

    .content-section {
        padding: 60px 20px 40px;
    }

    .subtitle {
        font-size: 1.3rem;
        margin-bottom: 50px;
    }

    .positions-grid {
        flex-direction: column;
        align-items: center;
        gap: 40px;
        margin-bottom: 60px;
    }

    .contact-text {
        font-size: 1.4rem;
    }

    .email-link {
        font-size: 1.2rem;
    }

    .email-container {
        padding: 12px 30px;
    }
}

@media (max-width: 480px) {
    .main-title {
        font-size: 2rem;
    }

    .subtitle {
        font-size: 1.1rem;
    }

    .contact-text {
        font-size: 1.2rem;
    }

    .email-link {
        font-size: 1.1rem;
    }

    .email-container {
        padding: 10px 25px;
    }
}
</style>