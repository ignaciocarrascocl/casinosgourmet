<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()

const isMenuOpen = ref(false)
const activeSection = ref('inicio')
const isNavbarVisible = ref(false)

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
}

const closeMenu = () => {
    isMenuOpen.value = false
}

const navigateToSection = async (sectionId) => {
    // Si no estamos en la página principal, navegar primero
    if (route.name !== 'home') {
        await router.push('/')
        // Esperar un poco para que la página se cargue
        await new Promise(resolve => setTimeout(resolve, 100))
    }
    
    // Hacer scroll a la sección
    const element = document.getElementById(sectionId)
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
    }
    closeMenu()
}

const updateActiveSection = () => {
    // Solo actualizar secciones activas si estamos en la página principal
    if (route.name !== 'home') {
        activeSection.value = ''
        return
    }

    const sections = ['inicio', 'porque-elegirnos', 'servicios', 'contacto']

    for (const sectionId of sections) {
        const element = document.getElementById(sectionId)
        if (element) {
            const rect = element.getBoundingClientRect()
            // Considera activa la sección que está más cerca del top del viewport
            if (rect.top <= 150 && rect.bottom >= 150) {
                activeSection.value = sectionId
                break
            }
        }
    }
}

onMounted(() => {
    // Animar el navbar al cargar
    setTimeout(() => {
        isNavbarVisible.value = true
    }, 100)

    window.addEventListener('scroll', updateActiveSection)
    updateActiveSection() // Ejecutar una vez al montar
})

onUnmounted(() => {
    window.removeEventListener('scroll', updateActiveSection)
})
</script>

<template>
    <header class="top-header" role="banner" :class="{
        'animate__animated animate__slideInDown': isNavbarVisible
    }">
        <div class="logo-container" :class="{
            'animate__animated animate__fadeInLeft': isNavbarVisible
        }" :style="{ animationDelay: '0.3s' }">
            <router-link to="/" @click="navigateToSection('inicio')" aria-label="Ir a página principal de Casinos Gourmet">
                <img src="/logonavbar.webp" alt="Casinos Gourmet - Servicios de Alimentación Empresarial" class="logo" width="270" height="146">
            </router-link>
        </div>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler d-lg-none" type="button" @click="toggleMenu" 
                :aria-expanded="isMenuOpen" 
                aria-controls="main-navigation"
                aria-label="Abrir menú de navegación"
                :class="{
                    'animate__animated animate__fadeIn': isNavbarVisible
                }" 
                :style="{ animationDelay: '0.5s' }">
            <span class="navbar-toggler-icon" aria-hidden="true"></span>
        </button>

        <nav class="main-nav" 
             id="main-navigation"
             role="navigation" 
             aria-label="Menú principal"
             :class="{
                 'show': isMenuOpen,
                 'animate__animated': isNavbarVisible
             }" 
             :style="{ animationDelay: '0.4s' }">
            <ul role="menubar">
                <li role="none" :class="{
                    active: activeSection === 'inicio' && route.name === 'home',
                    'animate__animated animate__slideInDown': isNavbarVisible
                }" :style="{ animationDelay: '0.6s' }">
                    <a href="#inicio" 
                       role="menuitem"
                       @click.prevent="navigateToSection('inicio')"
                       :aria-current="activeSection === 'inicio' && route.name === 'home' ? 'page' : null">
                        Inicio
                    </a>
                </li>
                <li role="none" :class="{
                    active: activeSection === 'porque-elegirnos' && route.name === 'home',
                    'animate__animated animate__slideInDown': isNavbarVisible
                }" :style="{ animationDelay: '0.7s' }">
                    <a href="#porque-elegirnos" 
                       role="menuitem"
                       @click.prevent="navigateToSection('porque-elegirnos')"
                       :aria-current="activeSection === 'porque-elegirnos' && route.name === 'home' ? 'page' : null">
                        ¿Por qué elegirnos?
                    </a>
                </li>
                <li role="none" :class="{
                    active: activeSection === 'servicios' && route.name === 'home',
                    'animate__animated animate__slideInDown': isNavbarVisible
                }" :style="{ animationDelay: '0.8s' }">
                    <a href="#servicios" 
                       role="menuitem"
                       @click.prevent="navigateToSection('servicios')"
                       :aria-current="activeSection === 'servicios' && route.name === 'home' ? 'page' : null">
                        Servicios
                    </a>
                </li>
                <li role="none" :class="{
                    active: activeSection === 'contacto' && route.name === 'home',
                    'animate__animated animate__slideInDown': isNavbarVisible
                }" :style="{ animationDelay: '0.9s' }">
                    <a href="#contacto" 
                       role="menuitem"
                       @click.prevent="navigateToSection('contacto')"
                       :aria-current="activeSection === 'contacto' && route.name === 'home' ? 'page' : null">
                        Contacto
                    </a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<style scoped>
@import '@/assets/variables.css';

/* Estados iniciales para animaciones */
.top-header {
    opacity: 0;
    transform: translateY(-100%);
}

.logo-container,
.navbar-toggler,
.main-nav {
    opacity: 0;
}

.main-nav li {
    opacity: 0;
    transform: translateY(-50px);
}

.top-header.animate__animated {
    opacity: 1;
    transform: translateY(0);
}

.logo-container.animate__animated,
.navbar-toggler.animate__animated,
.main-nav.animate__animated {
    opacity: 1;
}

.main-nav li.animate__animated {
    opacity: 1;
    transform: translateY(0);
}

.top-header {
    display: flex;
    width: 100%;
    min-height: 110px;
    /* Altura aumentada para acomodar elementos más grandes */
    font-family: var(--font-family);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: var(--verde);
    /* Todo el navbar verde */
    align-items: center;
    /* Asegura que todos los elementos dentro del header estén centrados verticalmente */
    position: fixed;
    top: 0;
    z-index: 1000;
}

.logo-container {
    width: 225px;
    /* Contenedor 25% más pequeño */
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    /* Alinear logo a la izquierda */
    padding: 0 10px;
    /* Añadir padding izquierdo */
    height: 100%;
    /* Asegura que el contenedor del logo ocupe toda la altura */
}

.logo {
    max-width: 270px;
    /* Logo 25% más pequeño (360px * 0.75) */
    max-height: 146px;
    /* Altura reducida proporcionalmente (195px * 0.75) */
    object-fit: contain;
    /* Mantiene la proporción */
    padding: 5px;
    /* Reducido para dar más espacio al logo */
}

.navbar-toggler {
    background: none;
    border: 2px solid var(--verde);
    /* Borde verde para el botón hamburguesa */
    border-radius: 8px;
    /* Esquinas redondeadas para el botón */
    padding: 8px;
    margin-right: 20px;
    cursor: pointer;
    display: none;
}

.navbar-toggler-icon {
    display: block;
    width: 25px;
    height: 3px;
    background-color: var(--verde);
    /* Icono hamburguesa verde */
    position: relative;
    transition: all 0.3s ease;
    margin: 8px 0;
    /* Añadir margen para separar las líneas */
}

.navbar-toggler-icon::before,
.navbar-toggler-icon::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 3px;
    background-color: var(--verde);
    /* Líneas del icono hamburguesa verdes */
    transition: all 0.3s ease;
    left: 0;
    /* Asegurar alineación */
}

.navbar-toggler-icon::before {
    top: -8px;
    /* Línea superior */
}

.navbar-toggler-icon::after {
    top: 8px;
    /* Línea inferior */
}

.main-nav {
    flex-grow: 1;
    display: flex;
    align-items: center;
    /* Centra verticalmente el menú en el header */
    padding-left: 50px;
    height: 100%;
}

.main-nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
}

.main-nav li {
    display: flex;
    height: 100%;
}

.main-nav a {
    color: black;
    text-decoration: none;
    font-weight: bold;
    font-size: 22px;
    /* Texto más grande */
    padding: 0 30px;
    /* Padding aumentado */
    height: 100%;
    display: flex;
    align-items: center;
    /* Centra verticalmente */
    position: relative;
}

.main-nav li a {
    position: relative;
}

/* Añadiendo la línea indicadora tanto para activo como para hover */
.main-nav li a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 15%;
    width: 70%;
    height: 4px;
    background-color: transparent;
    /* Inicialmente transparente */
    transition: background-color 0.3s ease;
    /* Transición suave */
}

/* Estado activo */
.main-nav li.active a::after {
    background-color: black;
    /* Cambiado a negro como solicitaste */
    bottom: 0;
    /* Aseguramos que esté en la parte inferior */
}

/* Estado hover */
.main-nav li a:hover::after {
    background-color: black;
    /* Misma línea negra en hover */
    bottom: 0;
    /* Aseguramos que esté en la parte inferior */
}

.main-nav a:hover,
.main-nav a.router-link-active {
    color: black;
    text-decoration: none;
}

/* Aseguramos que el texto activo esté en negrita */
.main-nav li.active a {
    font-weight: bold;
}

/* Media queries para responsive */
@media (max-width: 991.98px) {
    .top-header {
        flex-wrap: wrap;
        min-height: 80px;
        justify-content: space-between;
        background-color: white;
        /* Header blanco en móvil */
    }

    .logo-container {
        width: auto; /* Cambiado de 330px fijo a auto */
        max-width: calc(100vw - 80px); /* Asegurar que no sobrepase el viewport */
        background-color: white;
        /* Mantener fondo blanco */
        justify-content: flex-start;
        /* Alinear logo a la izquierda en móvil también */
        padding: 0 10px;
        /* Añadir padding izquierdo en móvil */
    }

    .logo {
        max-width: min(280px, calc(100vw - 100px)); /* Responsive y con límite absoluto */
        max-height: 112px;
        /* Altura aumentada proporcionalmente */
    }

    .navbar-toggler {
        display: block !important;
        margin-left: auto;
        /* Alinear a la derecha */
        margin-right: 15px;
    }

    .main-nav {
        width: 100%;
        order: 3;
        padding-left: 0;
        height: auto;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background-color: white;
        /* Fondo blanco para el dropdown */
    }

    .main-nav.show {
        max-height: 400px;
    }

    .main-nav ul {
        flex-direction: column;
        width: 100%;
        height: auto;
        padding: 10px;
        /* Padding para el contenedor */
    }

    .main-nav li {
        width: 100%;
        height: auto;
        margin-bottom: 0;
        /* Eliminar separación para usar separadores */
        border-top: none;
        /* Eliminar borde superior */
        position: relative;
    }

    /* Agregar separador similar al footer */
    .main-nav li:not(:last-child)::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, var(--rojo, #BA3028) 30%, var(--verde, #409100) 70%, transparent 100%);
        border-radius: 1px;
        opacity: 0.6;
    }

    .main-nav a {
        padding: 15px 20px;
        font-size: 18px;
        justify-content: center;
        height: auto;
        background-color: transparent;
        color: black;
        /* Texto negro en dropdown blanco */
        transition: all 0.3s ease;
        border: none;
        border-radius: 0;
        text-align: center;
    }

    .main-nav a:hover {
        background-color: rgba(0, 0, 0, 0.05);
        color: black;
        /* Hover con fondo gris muy claro */
    }

    .main-nav li a::after {
        display: none;
    }

    .main-nav li.active a {
        background-color: transparent;
        color: black;
        font-weight: bold;
        /* Elemento activo sin fondo, solo texto en negrita */
    }
}

@media (min-width: 992px) {
    .d-lg-none {
        display: none !important;
    }
}
</style>
