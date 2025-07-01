<template>
    <div ref="contactoRef" class="contacto-container" :class="{
        'animate__animated animate__fadeIn': isVisible
    }">
        <h1 class="contacto-title" :class="{
            'animate__animated animate__fadeInDown': isVisible
        }" :style="{ animationDelay: '0.2s' }">CONTACTO</h1>
        <div class="contacto-form" :class="{
            'animate__animated animate__fadeInUp': isVisible
        }" :style="{ animationDelay: '0.4s' }">
            <div class="form-field" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '0.6s' }">
                <input type="text" placeholder="NOMBRE:" />
            </div>
            <div class="form-field" :class="{
                'animate__animated animate__fadeInRight': isVisible
            }" :style="{ animationDelay: '0.8s' }">
                <input type="email" placeholder="E-MAIL:" />
            </div>
            <div class="form-field" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '1.0s' }">
                <input type="tel" placeholder="TELÉFONO:" />
            </div>
            <div class="form-field" :class="{
                'animate__animated animate__fadeInUp': isVisible
            }" :style="{ animationDelay: '1.2s' }">
                <textarea rows="5" placeholder="MENSAJE:"></textarea>
            </div>
            <button class="submit-btn" :class="{
                'animate__animated animate__pulse': isVisible
            }" :style="{ animationDelay: '1.4s' }">Solicitar Cotización</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

const contactoRef = ref(null)
const isVisible = ref(false)

useIntersectionObserver(
    contactoRef,
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
.contacto-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: var(--font-family);
}

/* Estados iniciales para animaciones */
.contacto-title,
.contacto-form,
.form-field,
.submit-btn {
    opacity: 0;
}

.contacto-title.animate__animated,
.contacto-form.animate__animated,
.form-field.animate__animated,
.submit-btn.animate__animated {
    opacity: 1;
}

.contacto-title {
    font-size: 5rem;
    font-weight: bold;
    color: var(--rojo);
    text-align: center;
    margin-bottom: 40px;
    letter-spacing: 2px;
}

.contacto-form {
    background-color: var(--rojo);
    padding: 40px;
    max-width: 800px;
    margin: 0 auto;
}

.form-field {
    margin-bottom: 20px;
}

.form-field input,
.form-field textarea {
    width: 100%;
    padding: 12px;
    border: none;
    font-size: 1rem;
    font-family: var(--font-family);
    background-color: #BD5B57;
    color: white;
    box-sizing: border-box;
}

.form-field input::placeholder,
.form-field textarea::placeholder {
    color: rgba(255, 255, 255, 0.8);
    font-weight: bold;
    letter-spacing: 1px;
}

.form-field input:focus,
.form-field textarea:focus {
    outline: none;
    background-color: #BD5B57;
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
}

.form-field textarea {
    resize: vertical;
    min-height: 100px;
}

.submit-btn {
    background-color: white;
    color: var(--rojo);
    border: none;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    font-family: var(--font-family);
    letter-spacing: 1px;
    display: block;
    margin: 30px auto 0;
    transition: all 0.3s ease;
}

.submit-btn:hover {
    background-color: #f0f0f0;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

@media (max-width: 768px) {
    .contacto-title {
        font-size: 3.125rem;
    }

    .contacto-form {
        padding: 30px 20px;
    }

    .submit-btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .contacto-title {
        font-size: 2.5rem;
    }

    .contacto-form {
        padding: 20px 15px;
    }
}
</style>