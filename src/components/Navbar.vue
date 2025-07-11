<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()
const isMenuOpen = ref(false)

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
}

const closeMenu = () => {
    isMenuOpen.value = false
}

const navigateToSection = async (sectionId) => {
    if (route.name !== 'home') {
        await router.push('/')
        await new Promise(resolve => setTimeout(resolve, 100))
    }
    
    const element = document.getElementById(sectionId)
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
    }
    closeMenu()
}
</script>

<template>
    <header class="top-header">
        <div class="logo-container">
            <router-link to="/" @click="navigateToSection('inicio')">
                <img src="/logonavbar.webp" alt="Casinos Gourmet Logo" class="logo">
            </router-link>
        </div>

        <button class="navbar-toggler d-lg-none" type="button" @click="toggleMenu" :aria-expanded="isMenuOpen">
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="main-nav" :class="{ 'show': isMenuOpen }">
            <ul>
                <li>
                    <a href="#" @click.prevent="navigateToSection('inicio')">Inicio</a>
                </li>
                <li>
                    <a href="#" @click.prevent="navigateToSection('porque-elegirnos')">¿Por qué elegirnos?</a>
                </li>
                <li>
                    <a href="#" @click.prevent="navigateToSection('servicios')">Servicios</a>
                </li>
                <li>
                    <a href="#" @click.prevent="navigateToSection('contacto')">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<style scoped>
@import '@/assets/variables.css';

.top-header {
    display: flex;
    width: 100%;
    font-family: var(--font-family);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: var(--verde);
    align-items: center;
    position: fixed;
    top: 0;
    z-index: 1000;
}

.logo-container {
    width: 225px;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 10px;
    height: 100%;
}

.logo {
    max-width: 324px;
    max-height: 120px; /* Reducido de 175px (30% menos) */
    object-fit: contain;
    padding: 5px;
}

.navbar-toggler {
    background: none;
    border: 2px solid var(--verde);
    border-radius: 8px;
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
    position: relative;
    transition: all 0.3s ease;
    margin: 8px 0;
}

.navbar-toggler-icon::before,
.navbar-toggler-icon::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 3px;
    background-color: var(--verde);
    transition: all 0.3s ease;
    left: 0;
}

.navbar-toggler-icon::before {
    top: -8px;
}

.navbar-toggler-icon::after {
    top: 8px;
}

.main-nav {
    flex-grow: 1;
    display: flex;
    align-items: center;
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
    padding: 0 30px;
    height: 100%;
    display: flex;
    align-items: center;
    position: relative;
    transition: color 0.3s ease;
}

.main-nav a:hover {
    color: #333;
}

/* Responsive */
@media (max-width: 991.98px) {
    .top-header {
        flex-wrap: wrap;
        min-height: 80px;
        justify-content: space-between;
        background-color: white;
    }

    .logo-container {
        max-width: calc(100vw - 80px);
        background-color: white;
        justify-content: flex-start;
        padding: 0;
        margin: 0;
    }

    .logo {
        max-width: min(280px, calc(100vw - 100px));
        max-height: 112px;
        padding: 5px;
        margin: 0;
    }

    .navbar-toggler {
        display: block !important;
        margin-left: auto;
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
    }

    .main-nav.show {
        max-height: 400px;
    }

    .main-nav ul {
        flex-direction: column;
        width: 100%;
        height: auto;
        padding: 10px;
    }

    .main-nav li {
        width: 100%;
        height: auto;
        margin-bottom: 0;
        position: relative;
    }

    .main-nav a {
        padding: 15px 20px;
        font-size: 18px;
        justify-content: center;
        height: auto;
        background-color: transparent;
        color: black;
        transition: all 0.3s ease;
        border: none;
        border-radius: 0;
        text-align: center;
        width: 100%;
        display: flex;
        align-items: center;
    }

    .main-nav a:hover {
        background-color: rgba(0, 0, 0, 0.05);
        color: black;
    }

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
}

@media (min-width: 992px) {
    .d-lg-none {
        display: none !important;
    }
}
</style>
