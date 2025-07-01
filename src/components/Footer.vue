<template>
    <footer ref="footerRef" class="footer" :class="{
        'animate__animated animate__fadeInUp': isVisible
    }">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo" :class="{
                    'animate__animated animate__fadeInLeft': isVisible
                }" :style="{ animationDelay: '0.2s' }">
                    <img src="/logonavbar.webp" alt="Casinos Gourmet Logo" class="logo" />
                </div>
                <div class="footer-contact" :class="{
                    'animate__animated animate__fadeInRight': isVisible
                }" :style="{ animationDelay: '0.4s' }">
                    <div class="contact-item">
                        <img src="/images/icons/whatsapp.png" alt="WhatsApp" class="contact-icon" />
                        <span>+569 44622619</span>
                    </div>
                    <div class="divider"></div>
                    <div class="contact-item">
                        <img src="/images/icons/email.png" alt="Email" class="contact-icon" />
                        <span>contacto@casinosgourmet.cl</span>
                    </div>
                    <div class="divider"></div>
                    <div class="contact-item">
                        <img src="/images/icons/spoon.png" alt="Trabaja con nosotros" class="contact-icon" />
                        <router-link to="/trabaja-con-nosotros" @click="scrollToTop">Trabaja con nosotros</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright" :class="{
            'animate__animated animate__fadeInUp': isVisible
        }" :style="{ animationDelay: '0.6s' }">
            <p>&copy; 2025 Casino Gourmet. Todos los derechos reservados.</p>
        </div>
    </footer>
</template>

<script setup>
import { ref } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'

const footerRef = ref(null)
const isVisible = ref(false)

useIntersectionObserver(
    footerRef,
    ([{ isIntersecting }]) => {
        if (isIntersecting) {
            isVisible.value = true
        }
    },
    {
        threshold: 0.1, // Activa cuando el 10% del footer es visible
        rootMargin: '50px' // Activa 50px antes de que el footer sea completamente visible
    }
)

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    })
}
</script>

<style scoped>
.footer {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    color: #333;
    width: 100%;
    font-family: var(--font-family, 'Montserrat', sans-serif);
    box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.footer.animate__animated {
    opacity: 1;
    transform: translateY(0);
}

.footer-logo,
.footer-contact,
.copyright {
    opacity: 0;
}

.footer-logo.animate__animated,
.footer-contact.animate__animated,
.copyright.animate__animated {
    opacity: 1;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 3rem 20px;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 3rem;
}

.footer-logo {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    flex: 1;
}

.logo {
    max-width: 350px;
    height: auto;
    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.1));
    transition: transform 0.3s ease;
}

.logo:hover {
    transform: scale(1.02);
}

.footer-contact {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    flex: 1;
    background: rgba(255, 255, 255, 0.8);
    padding: 2rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 18px;
    font-size: 2rem;
    font-weight: 500;
    color: #2c3e50;
    padding: 0.8rem 0;
    transition: all 0.3s ease;
    cursor: pointer;
}

.contact-item:nth-child(1) span,
.contact-item:nth-child(3) span {
    font-weight: bold;
}

.contact-item:hover {
    color: var(--rojo, #BA3028);
    transform: translateX(5px);
}

.contact-icon {
    width: 28px;
    height: 28px;
    min-width: 28px;
    transition: transform 0.3s ease;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.contact-item:hover .contact-icon {
    transform: scale(1.1);
}

.contact-item a,
.contact-item router-link {
    color: #2c3e50;
    text-decoration: none;
    font-weight: inherit;
    transition: color 0.3s ease;
}

.contact-item:hover a,
.contact-item:hover router-link {
    color: var(--rojo, #BA3028);
}

.divider {
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, var(--rojo, #BA3028) 30%, var(--verde, #409100) 70%, transparent 100%);
    width: 100%;
    border-radius: 1px;
    opacity: 0.6;
}

.copyright {
    background: linear-gradient(135deg, var(--negro, #000000) 0%, #1a1a1a 100%);
    color: white;
    text-align: center;
    padding: 1.5rem 0;
    width: 100%;
    font-size: 0.95rem;
    font-weight: 400;
    letter-spacing: 0.5px;
    margin-top: 1rem;
}

.copyright p {
    margin: 0;
    opacity: 0.9;
}

@media (max-width: 968px) {
    .footer-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 2rem;
    }

    .footer-contact {
        align-items: center;
        width: 100%;
        max-width: 500px;
    }

    .footer-logo {
        align-items: center;
    }

    .logo {
        max-width: 280px;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 2rem 15px;
    }

    .footer-contact {
        padding: 1.5rem;
        gap: 1.5rem;
    }

    .contact-item {
        font-size: 1rem;
        gap: 15px;
    }

    .contact-icon {
        width: 24px;
        height: 24px;
        min-width: 24px;
    }

    .logo {
        max-width: 240px;
    }
}
</style>