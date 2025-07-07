<template>
    <div ref="contactoRef" class="contacto-container">
        <h1 class="contacto-title">CONTACTO</h1>
        
        <!-- Success Message -->
        <div v-if="showSuccess" class="success-message">
            ¡Mensaje enviado exitosamente! Nos pondremos en contacto contigo pronto.
        </div>

        <form @submit.prevent="handleSubmit" class="contacto-form">
            <div class="form-field">
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
            <div class="form-field">
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
            <div class="form-field">
                <input 
                    type="tel" 
                    placeholder="TELÉFONO:" 
                    v-model="formData.phone"
                    name="phone"
                    :class="{ 'error': errors.phone }"
                />
                <span v-if="errors.phone" class="error-message">{{ errors.phone }}</span>
            </div>
            <div class="form-field">
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

            <!-- Simple Math CAPTCHA -->
            <div class="form-field captcha-field">
                <label class="captcha-label">
                    Verificación de seguridad: ¿Cuánto es {{ captcha.num1 }} + {{ captcha.num2 }}?
                </label>
                <input 
                    type="number" 
                    placeholder="Tu respuesta"
                    v-model.number="formData.captcha"
                    name="captcha"
                    required
                    :class="{ 'error': errors.captcha }"
                />
                <span v-if="errors.captcha" class="error-message">{{ errors.captcha }}</span>
            </div>
            
            <!-- Honeypot field (hidden from users) -->
            <input type="text" name="website" v-model="formData.website" style="display: none;" tabindex="-1" autocomplete="off">
            
            <button 
                type="submit"
                class="submit-btn" 
                :class="{
                    'loading': isLoading
                }" 
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
    message: '',
    captcha: '',
    website: '' // Honeypot field
})

const errors = reactive({
    name: '',
    email: '',
    phone: '',
    message: '',
    captcha: ''
})

// Generate simple math CAPTCHA
const captcha = reactive({
    num1: 0,
    num2: 0,
    answer: 0
})

const generateCaptcha = () => {
    captcha.num1 = Math.floor(Math.random() * 10) + 1
    captcha.num2 = Math.floor(Math.random() * 10) + 1
    captcha.answer = captcha.num1 + captcha.num2
}

// Initialize CAPTCHA on component mount
generateCaptcha()

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
    
    // Validate CAPTCHA
    if (!formData.captcha || formData.captcha !== captcha.answer) {
        errors.captcha = 'Respuesta incorrecta. Inténtalo de nuevo.'
        isValid = false
        generateCaptcha() // Generate new CAPTCHA on error
    }
    
    return isValid
}

const resetForm = () => {
    Object.keys(formData).forEach(key => {
        if (key !== 'website') { // Keep honeypot empty
            formData[key] = ''
        }
    })
    Object.keys(errors).forEach(key => errors[key] = '')
    generateCaptcha() // Generate new CAPTCHA after reset
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
        form.append('website', formData.website) // Honeypot
        
        const response = await fetch('./contact-handler.php', {
            method: 'POST',
            body: form
        })
        
        // Check if response is ok first
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
        }
        
        // Get response text first to debug if needed
        const responseText = await response.text()
        
        // Try to parse as JSON
        let result
        try {
            result = JSON.parse(responseText)
        } catch (jsonError) {
            console.error('Response is not valid JSON:', responseText)
            throw new Error('El servidor no respondió correctamente. Por favor intenta nuevamente.')
        }
        
        if (result.success) {
            showSuccess.value = true
            resetForm()
            setTimeout(() => {
                showSuccess.value = false
            }, 5000)
        } else {
            throw new Error(result.message || 'Error al enviar el formulario')
        }
    } catch (error) {
        console.error('Error:', error)
        alert(`Hubo un error al enviar el mensaje: ${error.message}. Por favor intenta nuevamente.`)
        generateCaptcha() // Generate new CAPTCHA on error
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
    background-color: #f8f9fa;
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: var(--font-family);
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

.captcha-field {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.captcha-label {
    display: block;
    color: white;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 1rem;
    letter-spacing: 1px;
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