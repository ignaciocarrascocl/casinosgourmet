<template>
    <section ref="serviciosRef" class="servicios-container" :class="{
        'animate__animated animate__fadeIn': isVisible
    }" aria-labelledby="servicios-heading">
        <h2 id="servicios-heading" class="servicios-titulo" :class="{
            'animate__animated animate__fadeInDown': isVisible
        }" :style="{ animationDelay: '0.2s' }">SERVICIOS</h2>

        <div class="servicios-content">
            <!-- Desayunos y Onces -->
            <article class="servicio-row" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '0.4s' }" itemscope itemtype="https://schema.org/Service">
                <div class="servicio-item desayunos-imagen" role="img" aria-label="Imagen de desayunos empresariales variados y nutritivos"></div>
                <div class="servicio-info rojo">
                    <h3 itemprop="name">DESAYUNOS Y ONCES</h3>
                    <p itemprop="description">Desayunos y onces saludables y tradicionales para mantener la energía durante toda la jornada laboral.</p>
                </div>
            </article>

            <!-- Almuerzos y Cenas -->
            <article class="servicio-row reverse" :class="{
                'animate__animated animate__fadeInRight': isVisible
            }" :style="{ animationDelay: '0.6s' }" itemscope itemtype="https://schema.org/Service">
                <div class="servicio-item almuerzos-imagen" role="img" aria-label="Imagen de almuerzos corporativos con salad bar y múltiples opciones"></div>
                <div class="servicio-info verde">
                    <h3 itemprop="name">ALMUERZOS Y CENAS</h3>
                    <p itemprop="description">Salad Bar fresco, sopas naturales, tres opciones de plato principal incluyendo una opción hipocalórica, postres variados y jugos sin azúcar para una alimentación balanceada.</p>
                </div>
            </article>

            <!-- Colaciones y Coffee Breaks -->
            <article class="servicio-row" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '0.8s' }" itemscope itemtype="https://schema.org/Service">
                <div class="servicio-item colaciones-imagen" role="img" aria-label="Imagen de colaciones y coffee breaks para eventos empresariales"></div>
                <div class="servicio-info rojo">
                    <h3 itemprop="name">COLACIONES Y COFFEE BREAKS</h3>
                    <p itemprop="description">Opciones ideales para eventos, reuniones y coffee breaks empresariales con variedades dulces y saladas.</p>
                </div>
            </article>

            <!-- Eventos Gastronómicos -->
            <article class="servicio-row reverse" :class="{
                'animate__animated animate__fadeInRight': isVisible
            }" :style="{ animationDelay: '1.0s' }" itemscope itemtype="https://schema.org/Service">
                <div class="servicio-item eventos-imagen" role="img" aria-label="Imagen de eventos gastronómicos corporativos y celebraciones especiales"></div>
                <div class="servicio-info verde">
                    <h3 itemprop="name">EVENTOS GASTRONÓMICOS</h3>
                    <p itemprop="description">Servicios gastronómicos únicos y personalizados para eventos corporativos, celebraciones y ocasiones especiales en tu empresa.</p>
                </div>
            </article>
        </div>
    </section>
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
    font-size: 5rem;
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

.servicio-info h3 {
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

    .servicio-info h3 {
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
