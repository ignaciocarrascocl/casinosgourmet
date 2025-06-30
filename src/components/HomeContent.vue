<template>
    <div ref="homeRef" class="home-container" :class="{
        'animate__animated animate__fadeIn': isVisible
    }">
        <div class="hero-section">
            <div class="hero-content" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '0.3s' }">
                <h2 class="somos" :class="{
                    'animate__animated animate__fadeInDown': isVisible
                }" :style="{ animationDelay: '0.5s' }">SOMOS</h2>
                <div class="brand" :class="{
                    'animate__animated animate__zoomIn': isVisible
                }" :style="{ animationDelay: '0.7s' }">
                    <span class="casinos">CASINOS</span><span class="gourmet">GOURMET</span>
                </div>
                <h2 class="especialistas" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '0.9s' }">ESPECIALISTAS EN<br>ALIMENTACIÓN<br>COLECTIVA</h2>
                <button class="quote-button" :class="{
                    'animate__animated animate__pulse': isVisible
                }" :style="{ animationDelay: '1.1s' }">Solicitar Cotización</button>
            </div>
            <div class="slogan-section" :class="{
                'animate__animated animate__fadeInRight': isVisible
            }" :style="{ animationDelay: '1.3s' }">
                <h3>"Creamos soluciones adaptadas para cada cliente"</h3>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

export default {
    name: 'HomeContent',
    setup() {
        const homeRef = ref(null)
        const isVisible = ref(false)

        useIntersectionObserver(
            homeRef,
            ([{ isIntersecting }]) => {
                if (isIntersecting) {
                    isVisible.value = true
                }
            },
            {
                threshold: 0.2,
                rootMargin: '50px'
            }
        )

        return {
            homeRef,
            isVisible
        }
    }
}
</script>

<style scoped>
.home-container {
    width: 100%;
    font-family: var(--font-family);
    max-width: 100%;
    overflow: hidden;
}

/* Estados iniciales para animaciones */
.hero-content,
.somos,
.brand,
.especialistas,
.quote-button,
.slogan-section {
    opacity: 0;
}

.hero-content.animate__animated,
.somos.animate__animated,
.brand.animate__animated,
.especialistas.animate__animated,
.quote-button.animate__animated,
.slogan-section.animate__animated {
    opacity: 1;
}

.hero-section {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0;
    background-color: #ffffff;
    width: 100%;
    position: relative;
    min-height: 100vh;
    background-image: url('/plato.webp');
    background-size: 50% auto;
    background-position: right 30%;
    /* Ajustado para que la imagen quede por encima de la cita */
    background-repeat: no-repeat;
}

.hero-content {
    padding: 2rem 2rem 2rem 4rem;
    width: 45%;
    /* Ajustado a un valor más apropiado */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    /* Alinea el contenido al inicio (izquierda) */
    height: auto;
    /* Altura automática basada en el contenido */
    max-width: none;
    /* Eliminado el max-width redundante */
    box-sizing: border-box;
    /* Incluye padding en el cálculo del ancho */
    position: relative;
    /* Para posicionamiento relativo */
    z-index: 2;
    /* Asegura que el contenido esté por encima del fondo */
}

.somos {
    font-size: 2.4rem;
    /* Reducido en 20% de 3rem */
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--negro);
}

.brand {
    margin-bottom: 1.5rem;
}

.casinos {
    background-color: var(--rojo);
    color: white;
    font-size: 2.8rem;
    /* Reducido en 20% de 3.5rem */
    font-weight: 800;
    padding: 0.2rem 0.5rem;
}

.gourmet {
    background-color: var(--verde);
    color: white;
    font-size: 2.8rem;
    /* Reducido en 20% de 3.5rem */
    font-weight: 800;
    padding: 0.2rem 0.5rem;
}

.especialistas {
    font-size: 2rem;
    /* Reducido en 20% de 2.5rem */
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 2rem;
    color: var(--negro);
}

.quote-button {
    background-color: var(--rojo);
    color: white;
    border: none;
    padding: 0.8rem 1.6rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    font-family: var(--font-family);
    transition: background-color 0.3s ease;
    display: inline-block;
    width: fit-content;
    /* Cambiado para que se ajuste exactamente al contenido */
    max-width: max-content;
    /* Asegura que no crezca más allá del contenido */
    margin: 0;
}

.quote-button:hover {
    background-color: #9c2720;
}

.slogan-section {
    background-color: var(--rojo);
    color: black;
    padding: 1.2rem;
    /* Reducido en 20% de 1.5rem */
    text-align: center;
    position: absolute;
    /* Posicionamiento absoluto para colocarlo dentro de hero-section */
    bottom: 0;
    /* Lo coloca en la parte inferior de hero-section */
    width: 100%;
    /* Ocupa todo el ancho */
}

.slogan-section h3 {
    font-size: 1.6rem;
    /* Reducido en 20% de 2rem */
    font-weight: 600;
    margin: 0;
    color: black;
}

/* Diseño responsive */
@media (max-width: 900px) {
    .hero-section {
        flex-direction: column;
        padding: 0;
        margin: 0;
        min-height: 100vh;
        background-position: center top;
        background-size: 100% auto;
        width: 100%;
        box-sizing: border-box;
    }

    .hero-content {
        padding: 16rem 1rem 2rem 1rem;
        margin-top: 0;
        margin-bottom: 2rem;
        text-align: center;
        width: 100%;
        margin-left: 0;
        margin-right: 0;
        align-items: center;
        min-height: auto;
        border-radius: 8px;
        box-sizing: border-box;
    }

    .somos {
        font-size: 2rem;
    }

    .casinos,
    .gourmet {
        font-size: 1.8rem;
        padding: 0.15rem 0.3rem;
    }

    .especialistas {
        font-size: 1.6rem;
    }

    .slogan-section {
        position: relative;
        margin-top: auto;
        margin-bottom: 1rem;
        width: 100%;
        box-sizing: border-box;
        left: 0;
        right: 0;
    }

    .slogan-section h3 {
        font-size: 1.2rem;
    }
}

@media (max-width: 480px) {
    .casinos,
    .gourmet {
        font-size: 1.5rem;
        padding: 0.1rem 0.25rem;
    }
    
    .hero-content {
        padding: 20rem 0.5rem 1.5rem 0.5rem;
        margin-top: 0;
    }
}
</style>