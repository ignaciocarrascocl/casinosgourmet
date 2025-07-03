<template>
    <div ref="contactoRef" class="contacto-container" :class="{
        'animate__animated animate__fadeIn': isVisible
    }">
        <h1 class="contacto-title" :class="{
            'animate__animated animate__fadeInDown': isVisible
        }" :style="{ animationDelay: '0.2s' }">CONTACTO</h1>
        
        <!-- Success Message -->
        <div v-if="showSuccess" class="success-message animate__animated animate__fadeInDown">
            ¡Mensaje enviado exitosamente! Nos pondremos en contacto contigo pronto.
        </div>

        <form @submit.prevent="handleSubmit" class="contacto-form" :class="{
            'animate__animated animate__fadeInUp': isVisible
        }" :style="{ animationDelay: '0.4s' }">
            <div class="form-field" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '0.6s' }">
                <input 
                    type="text" 
                    placeholder="NOMBRE:" 
                    v-model="formData.name"
                    name="name"
                    required
                    :class="{ 'error': errors.name }"
                />
                <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
            </div>
            <div class="form-field" :class="{
                'animate__animated animate__fadeInRight': isVisible
            }" :style="{ animationDelay: '0.8s' }">
                <input 
                    type="email" 
                    placeholder="E-MAIL:" 
                    v-model="formData.email"
                    name="email"
                    required
                    :class="{ 'error': errors.email }"
                />
                <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
            </div>
            <div class="form-field" :class="{
                'animate__animated animate__fadeInLeft': isVisible
            }" :style="{ animationDelay: '1.0s' }">
                <input 
                    type="tel" 
                    placeholder="TELÉFONO:" 
                    v-model="formData.phone"
                    name="phone"
                    :class="{ 'error': errors.phone }"
                />
                <span v-if="errors.phone" class="error-message">{{ errors.phone }}</span>
            </div>
            <div class="form-field" :class="{
                'animate__animated animate__fadeInUp': isVisible
            }" :style="{ animationDelay: '1.2s' }">
                <textarea 
                    rows="5" 
                    placeholder="MENSAJE:"
                    v-model="formData.message"
                    name="message"
                    required
                    :class="{ 'error': errors.message }"
                ></textarea>
                <span v-if="errors.message" class="error-message">{{ errors.message }}</span>
            </div>
            
            <!-- Hidden fields for FormSubmit.co -->
            <input type="hidden" name="_next" value="https://casinosgourmet.cl/gracias">
            <input type="hidden" name="_subject" value="Nueva cotización desde CasinosGourmet.cl">
            <input type="hidden" name="_captcha" value="false">
            
            <button 
                type="submit"
                class="submit-btn" 
                :class="{
                    'animate__animated animate__pulse': isVisible,
                    'loading': isLoading
                }" 
                :style="{ animationDelay: '1.4s' }"
                :disabled="isLoading"
            >
                {{ isLoading ? 'Enviando...' : 'Solicitar Cotización' }}
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

const contactoRef = ref(null)
const isVisible = ref(false)
const isLoading = ref(false)
const showSuccess = ref(false)

const formData = reactive({
    name: '',
    email: '',
    phone: '',
    message: ''
})

const errors = reactive({
    name: '',
    email: '',
    phone: '',
    message: ''
})

const validateForm = () => {
    let isValid = true
    
    // Clear previous errors
    Object.keys(errors).forEach(key => errors[key] = '')
    
    // Validate name
    if (!formData.name.trim()) {
        errors.name = 'El nombre es requerido'
        isValid = false
    }
    
    // Validate email
    if (!formData.email.trim()) {
        errors.email = 'El email es requerido'
        isValid = false
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
        errors.email = 'Por favor ingresa un email válido'
        isValid = false
    }
    
    // Validate message
    if (!formData.message.trim()) {
        errors.message = 'El mensaje es requerido'
        isValid = false
    }
    
    return isValid
}

const resetForm = () => {
    Object.keys(formData).forEach(key => formData[key] = '')
    Object.keys(errors).forEach(key => errors[key] = '')
}

const handleSubmit = async () => {
    if (!validateForm()) return
    
    isLoading.value = true
    
    try {
        const form = new FormData()
        form.append('name', formData.name)
        form.append('email', formData.email)
        form.append('phone', formData.phone)
        form.append('message', formData.message)
        form.append('_next', 'https://casinosgourmet.cl/gracias')
        form.append('_subject', 'Nueva cotización desde CasinosGourmet.cl')
        form.append('_captcha', 'false')
        
        const response = await fetch('https://formsubmit.co/contacto@casinosgourmet.cl', {
            method: 'POST',
            body: form
        })
        
        if (response.ok) {
            showSuccess.value = true
            resetForm()
            setTimeout(() => {
                showSuccess.value = false
            }, 5000)
        } else {
            throw new Error('Error al enviar el formulario')
        }
    } catch (error) {
        console.error('Error:', error)
        alert('Hubo un error al enviar el mensaje. Por favor intenta nuevamente.')
    } finally {
        isLoading.value = false
    }
}

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

.success-message {
    background-color: #4CAF50;
    color: white;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
}

.contacto-form {
    background-color: var(--rojo);
    padding: 40px;
    max-width: 800px;
    margin: 0 auto;
}

.form-field {
    margin-bottom: 20px;
    position: relative;
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
    transition: all 0.3s ease;
}

.form-field input.error,
.form-field textarea.error {
    border: 2px solid #ffeb3b;
    background-color: #a94442;
}

.error-message {
    color: #ffeb3b;
    font-size: 0.9rem;
    margin-top: 5px;
    display: block;
    font-weight: bold;
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
    position: relative;
}

.submit-btn:hover:not(:disabled) {
    background-color: #f0f0f0;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.submit-btn.loading {
    pointer-events: none;
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