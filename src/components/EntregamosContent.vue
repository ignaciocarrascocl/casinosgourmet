<template>
    <div ref="entregamosRef" class="entregamos-container" :class="{
        'animate__animated animate__fadeIn': isVisible
    }">
        <div class="container">
            <h1 class="title" :class="{
                'animate__animated animate__fadeInDown': isVisible
            }" :style="{ animationDelay: '0.2s' }">ENTREGAMOS</h1>

            <div class="counter-container" :class="{
                'animate__animated animate__zoomIn': isVisible
            }" :style="{ animationDelay: '0.4s' }">
                <div class="counter">{{ formattedCounter }}</div>
            </div>

            <h2 class="subtitle" :class="{
                'animate__animated animate__fadeInUp': isVisible
            }" :style="{ animationDelay: '0.6s' }">SERVICIOS MENSUALMENTE</h2>

            <div class="entregamos-gallery">
                <div class="gallery-item" :class="{
                    'animate__animated animate__fadeInLeft': isVisible
                }" :style="{ animationDelay: '0.8s' }">
                    <img src="/images/entregamos/foto1.webp" alt="Servicio gastronómico" />
                </div>
                <div class="gallery-item" :class="{
                    'animate__animated animate__fadeInUp': isVisible
                }" :style="{ animationDelay: '1.0s' }">
                    <img src="/images/entregamos/foto2.webp" alt="Opciones gastronómicas" />
                </div>
                <div class="gallery-item" :class="{
                    'animate__animated animate__fadeInDown': isVisible
                }" :style="{ animationDelay: '1.2s' }">
                    <img src="/images/entregamos/foto3.webp" alt="Cafetería" />
                </div>
                <div class="gallery-item" :class="{
                    'animate__animated animate__fadeInRight': isVisible
                }" :style="{ animationDelay: '1.4s' }">
                    <img src="/images/entregamos/foto4.webp" alt="Comedor" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

const entregamosRef = ref(null)
const isVisible = ref(false)
const animatedCounter = ref(1)

const formattedCounter = computed(() => {
    return animatedCounter.value.toLocaleString('es-ES')
})

const animateCounter = () => {
    const duration = 2000 // 2 segundos
    const targetValue = 50000
    const startValue = 1
    const startTime = Date.now()
    
    const updateCounter = () => {
        const elapsed = Date.now() - startTime
        const progress = Math.min(elapsed / duration, 1)
        
        // Usar función de easing para una animación más suave
        const easeOutQuart = 1 - Math.pow(1 - progress, 4)
        const currentValue = Math.round(startValue + (targetValue - startValue) * easeOutQuart)
        
        animatedCounter.value = currentValue
        
        if (progress < 1) {
            requestAnimationFrame(updateCounter)
        }
    }
    
    requestAnimationFrame(updateCounter)
}

useIntersectionObserver(
    entregamosRef,
    ([{ isIntersecting }]) => {
        if (isIntersecting && !isVisible.value) {
            isVisible.value = true
            // Iniciar animación del contador después de un pequeño delay
            setTimeout(() => {
                animateCounter()
            }, 600) // Coincide con el delay de la animación del contador container
        }
    },
    {
        threshold: 0.1,
        rootMargin: '50px'
    }
)
</script>

<style scoped>
.entregamos-container {
    width: 100%;
    padding: 0;
    background-color: #000;
    color: #fff;
    text-align: center;
}

/* Estados iniciales para animaciones */
.title,
.counter-container,
.subtitle,
.gallery-item {
    opacity: 0;
}

.title.animate__animated,
.counter-container.animate__animated,
.subtitle.animate__animated,
.gallery-item.animate__animated {
    opacity: 1;
}

/* Estados iniciales para animaciones */
.title,
.counter-container,
.subtitle,
.gallery-item {
    opacity: 0;
}

.title.animate__animated,
.counter-container.animate__animated,
.subtitle.animate__animated,
.gallery-item.animate__animated {
    opacity: 1;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 200px 20px;
}

.title {
    font-size: 4rem;
    font-weight: bold;
    margin-bottom: 30px;
    letter-spacing: 2px;
}

.counter-container {
    margin: 20px auto 30px;
    background-color: #55a318;
    /* Color verde del diseño */
    display: inline-block;
    padding: 5px 40px;
    margin-bottom: 20px;
}

.counter {
    font-size: 7rem;
    font-weight: bold;
    line-height: 1;
    color: #fff;
}

.subtitle {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 50px;
    letter-spacing: 1px;
}

.entregamos-gallery {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-top: 40px;
}

.gallery-item {
    flex: 1;
    max-width: 24%;
    overflow: hidden;
}

.gallery-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

@media (max-width: 991px) {
    .title {
        font-size: 3rem;
    }

    .counter {
        font-size: 5rem;
    }

    .subtitle {
        font-size: 2.5rem;
        margin-bottom: 30px;
    }
}

@media (max-width: 768px) {
    .entregamos-gallery {
        flex-wrap: wrap;
        justify-content: center;
    }

    .gallery-item {
        flex: 0 0 48%;
        max-width: 48%;
        margin-bottom: 15px;
    }

    .title {
        font-size: 2.5rem;
    }

    .counter {
        font-size: 4rem;
    }

    .subtitle {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .gallery-item {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
