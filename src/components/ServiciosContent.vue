<template>
    <div ref="serviciosRef" class="servicios-container" :class="{
        'animate__animated animate__fadeIn': isVisible
    }">
        <h1 class="servicios-titulo" :class="{
            'animate__animated animate__fadeInDown': isVisible
        }" :style="{ animationDelay: '0.2s' }">SERVICIOS</h1>

        <div class="servicios-content">
            <!-- Desayunos y Onces -->
            <div class="servicio-row" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '0.4s' }">
                <div class="servicio-item desayunos-imagen"></div>
                <div class="servicio-info rojo">
                    <h2>DESAYUNOS Y ONCES</h2>
                    <p>Saludables y tradicionales.</p>
                </div>
            </div>

            <!-- Almuerzos y Cenas -->
            <div class="servicio-row reverse" :class="{
                'animate__animated animate__fadeInRight': isVisible
            }" :style="{ animationDelay: '0.6s' }">
                <div class="servicio-item almuerzos-imagen"></div>
                <div class="servicio-info verde">
                    <h2>ALMUERZOS Y CENAS</h2>
                    <p>Salad Bar, sopas naturales, tres opciones de plato principal (una hipocalórica), postres variados
                        y jugos sin azúcar.</p>
                </div>
            </div>

            <!-- Colaciones y Coffee Breaks -->
            <div class="servicio-row" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '0.8s' }">
                <div class="servicio-item colaciones-imagen"></div>
                <div class="servicio-info rojo">
                    <h2>COLACIONES Y COFFEE BREAKS</h2>
                    <p>Opciones ideales para eventos y reuniones.</p>
                </div>
            </div>

            <!-- Eventos Gastronómicos -->
            <div class="servicio-row reverse" :class="{
                'animate__animated animate__fadeInRight': isVisible
            }" :style="{ animationDelay: '1.0s' }">
                <div class="servicio-item eventos-imagen"></div>
                <div class="servicio-info verde">
                    <h2>EVENTOS GASTRONÓMICOS</h2>
                    <p>Servicios únicos para eventos y ocasiones especiales</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

const serviciosRef = ref(null)
const isVisible = ref(false)

useIntersectionObserver(
    serviciosRef,
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
.servicios-container {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

/* Estados iniciales para animaciones */
.servicios-titulo,
.servicio-row {
    opacity: 0;
}

.servicios-titulo.animate__animated,
.servicio-row.animate__animated {
    opacity: 1;
}

.servicios-titulo {
    text-align: center;
    color: var(--rojo);
    font-size: 3rem;
    margin-bottom: 50px;
    font-weight: 700;
}

.servicios-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.servicio-row {
    display: flex;
    width: 100%;
    height: 360px;
    /* 20% más alto que los 300px originales */
    gap: 20px;
    /* Espacio entre la imagen y el cuadro de texto */
}

.servicio-row.reverse {
    flex-direction: row-reverse;
}

.servicio-item {
    width: calc(45% - 10px);
    /* Cambiado a 45% */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.servicio-info {
    width: calc(55% - 10px);
    /* Cambiado a 55% */
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 30px;
    color: white;
}

.desayunos-imagen {
    background-image: url('/images/servicios/desayunos.webp');
}

.almuerzos-imagen {
    background-image: url('/images/servicios/almuerzos.webp');
}

.colaciones-imagen {
    background-image: url('/images/servicios/colaciones.webp');
}

.eventos-imagen {
    background-image: url('/images/servicios/eventos.webp');
}

.rojo {
    background-color: var(--rojo);
}

.verde {
    background-color: var(--verde);
}

.servicio-info h2 {
    font-size: 1.8rem;
    margin-bottom: 15px;
    font-weight: 600;
}

.servicio-info p {
    font-size: 1.1rem;
    line-height: 1.5;
}

/* Responsive design */
@media (max-width: 768px) {
    .servicios-titulo {
        font-size: 2.3rem;
    }

    .servicio-info h2 {
        font-size: 1.5rem;
    }

    .servicio-row,
    .servicio-row.reverse {
        flex-direction: column;
        height: auto;
    }

    .servicio-item {
        width: 100%;
        height: 240px;
        /* También 20% más alto para móviles */
    }

    .servicio-info {
        width: 100%;
        min-height: 240px;
        /* También 20% más alto para móviles */
    }

    /* Espacio vertical entre imagen y texto en móviles */
    .servicio-row {
        gap: 15px;
    }
}
</style>
