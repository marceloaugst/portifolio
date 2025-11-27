import "./bootstrap";

// ============================================
// Demonstração de Skills em JavaScript
// ============================================

/**
 * Classe para gerenciar tema (Dark/Light Mode)
 * Demonstra: Classes ES6, LocalStorage, DOM Manipulation
 */
class ThemeManager {
    constructor() {
        this.theme = localStorage.getItem("theme") || "system";
        this.init();
    }

    init() {
        // Aplica tema salvo
        this.applyTheme();

        // Adiciona listener para mudanças de preferência do sistema
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (e) => {
                if (this.theme === "system") {
                    this.applyTheme();
                }
            });
    }

    applyTheme() {
        const isDark =
            this.theme === "dark" ||
            (this.theme === "system" &&
                window.matchMedia("(prefers-color-scheme: dark)").matches);

        document.documentElement.classList.toggle("dark", isDark);
    }

    setTheme(newTheme) {
        this.theme = newTheme;
        localStorage.setItem("theme", newTheme);
        this.applyTheme();
    }
}

/**
 * Animação de digitação (Typing Effect)
 * Demonstra: Promises, async/await, Animações
 */
class TypingEffect {
    constructor(element, texts, options = {}) {
        this.element = element;
        this.texts = texts;
        this.currentTextIndex = 0;
        this.options = {
            typingSpeed: options.typingSpeed || 100,
            deletingSpeed: options.deletingSpeed || 50,
            pauseDuration: options.pauseDuration || 2000,
            loop: options.loop !== false,
        };
    }

    async type(text) {
        for (let i = 0; i <= text.length; i++) {
            this.element.textContent = text.substring(0, i);
            await this.delay(this.options.typingSpeed);
        }
    }

    async delete() {
        const text = this.element.textContent;
        for (let i = text.length; i >= 0; i--) {
            this.element.textContent = text.substring(0, i);
            await this.delay(this.options.deletingSpeed);
        }
    }

    delay(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }

    async start() {
        while (true) {
            const currentText = this.texts[this.currentTextIndex];

            await this.type(currentText);
            await this.delay(this.options.pauseDuration);
            await this.delete();

            this.currentTextIndex =
                (this.currentTextIndex + 1) % this.texts.length;

            if (!this.options.loop && this.currentTextIndex === 0) break;
        }
    }
}

/**
 * Scroll Animations Observer
 * Demonstra: Intersection Observer API
 */
class ScrollAnimations {
    constructor(selector = "[data-animate]") {
        this.elements = document.querySelectorAll(selector);
        this.init();
    }

    init() {
        const options = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animated");
                    // Opcional: parar de observar após animar
                    // observer.unobserve(entry.target);
                }
            });
        }, options);

        this.elements.forEach((element) => observer.observe(element));
    }
}

/**
 * Smooth Scroll com efeito personalizado
 * Demonstra: Event delegation, preventDefault, animações suaves
 */
class SmoothScroll {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener("click", (e) => {
            const anchor = e.target.closest('a[href^="#"]');
            if (!anchor) return;

            const href = anchor.getAttribute("href");
            if (href === "#") return;

            const target = document.querySelector(href);
            if (!target) return;

            e.preventDefault();

            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });

            // Atualiza URL sem recarregar
            history.pushState(null, null, href);
        });
    }
}

/**
 * Particle Effect (efeito de partículas no mouse)
 * Demonstra: Canvas API, requestAnimationFrame, Event listeners
 */
class ParticleEffect {
    constructor(canvasId) {
        this.canvas = document.getElementById(canvasId);
        if (!this.canvas) return;

        this.ctx = this.canvas.getContext("2d");
        this.particles = [];
        this.maxParticles = 50;
        this.init();
    }

    init() {
        this.resizeCanvas();
        window.addEventListener("resize", () => this.resizeCanvas());

        this.canvas.addEventListener("mousemove", (e) => {
            this.createParticle(e.clientX, e.clientY);
        });

        this.animate();
    }

    resizeCanvas() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createParticle(x, y) {
        if (this.particles.length >= this.maxParticles) {
            this.particles.shift();
        }

        this.particles.push({
            x,
            y,
            vx: (Math.random() - 0.5) * 2,
            vy: (Math.random() - 0.5) * 2,
            life: 1,
            size: Math.random() * 3 + 1,
        });
    }

    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        this.particles = this.particles.filter((particle) => {
            particle.x += particle.vx;
            particle.y += particle.vy;
            particle.life -= 0.02;

            this.ctx.fillStyle = `rgba(245, 48, 3, ${particle.life})`;
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fill();

            return particle.life > 0;
        });

        requestAnimationFrame(() => this.animate());
    }
}

/**
 * Debounce utility
 * Demonstra: Closures, Higher-order functions
 * Útil em Flutter (Timer) e React Native (setTimeout)
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Simulador de responsividade mobile
 * Demonstra: Conceitos aplicados em Flutter e React Native
 */
class MobileResponsiveness {
    constructor() {
        this.breakpoints = {
            mobile: 640,
            tablet: 768,
            desktop: 1024,
        };
        this.init();
    }

    init() {
        this.checkDevice();
        window.addEventListener(
            "resize",
            debounce(() => {
                this.checkDevice();
            }, 250)
        );
    }

    checkDevice() {
        const width = window.innerWidth;
        let device = "desktop";

        if (width < this.breakpoints.mobile) {
            device = "mobile";
        } else if (width < this.breakpoints.tablet) {
            device = "tablet";
        }

        document.body.setAttribute("data-device", device);

        // Dispara evento customizado (similar ao MediaQuery do Flutter)
        window.dispatchEvent(
            new CustomEvent("deviceChange", {
                detail: { device, width },
            })
        );
    }

    // Método inspirado no MediaQuery.of(context).size do Flutter
    static getDeviceSize() {
        return {
            width: window.innerWidth,
            height: window.innerHeight,
            aspectRatio: window.innerWidth / window.innerHeight,
        };
    }
}

/**
 * Sistema de navegação inspirado em React Navigation (React Native)
 * Demonstra: Stack navigation concepts
 */
class NavigationStack {
    constructor() {
        this.stack = [];
        this.currentRoute = "/";
    }

    push(route, params = {}) {
        this.stack.push({ route: this.currentRoute, params });
        this.currentRoute = route;
        this.navigate(route, params);
    }

    pop() {
        if (this.stack.length > 0) {
            const previous = this.stack.pop();
            this.currentRoute = previous.route;
            this.navigate(previous.route, previous.params);
            return previous;
        }
        return null;
    }

    navigate(route, params = {}) {
        // Implementação básica de navegação
        console.log(`Navegando para: ${route}`, params);

        // Atualiza URL sem recarregar (similar ao Navigator do Flutter/RN)
        if (history.pushState) {
            const url = new URL(window.location);
            url.pathname = route;
            history.pushState(params, "", url);
        }
    }

    canGoBack() {
        return this.stack.length > 0;
    }
}

/**
 * Lazy Loading de imagens
 * Demonstra: Intersection Observer, Performance optimization
 */
class LazyLoader {
    constructor(selector = "img[data-src]") {
        this.images = document.querySelectorAll(selector);
        this.init();
    }

    init() {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add("loaded");
                    imageObserver.unobserve(img);
                }
            });
        });

        this.images.forEach((img) => imageObserver.observe(img));
    }
}

// ============================================
// Inicialização quando o DOM estiver pronto
// ============================================
document.addEventListener("DOMContentLoaded", () => {
    // Inicializa gerenciador de tema
    window.themeManager = new ThemeManager();

    // Mobile Responsiveness (conceitos de Flutter/React Native)
    window.mobileResponsiveness = new MobileResponsiveness();

    // Navigation Stack (inspirado em React Navigation)
    window.navigation = new NavigationStack();

    // Scroll Animations
    new ScrollAnimations();

    // Smooth Scroll
    new SmoothScroll();

    // Lazy Loading
    new LazyLoader();

    // Exemplo de typing effect (se houver elemento)
    const typingElement = document.querySelector("[data-typing]");
    if (typingElement) {
        const texts = typingElement.dataset.typing.split("|");
        new TypingEffect(typingElement, texts).start();
    }

    // Console message para recrutadores
    console.log(
        "%c👋 Olá, Recrutador!",
        "color: #F53003; font-size: 24px; font-weight: bold;"
    );
    console.log(
        "%cSe você está lendo isso, aqui está um Easter Egg! 🎉\n" +
            "Este portfólio foi desenvolvido com Laravel + JavaScript moderno.\n" +
            "Confira o código fonte para ver mais detalhes técnicos.",
        "color: #1b1b18; font-size: 14px;"
    );
    console.log(
        "%c📱 Mobile Development Stack:",
        "color: #F53003; font-size: 16px; font-weight: bold; margin-top: 10px;"
    );
    console.log(
        "%c• Flutter (Dart) - Cross-platform mobile apps\n" +
            "• React Native - JavaScript mobile development\n" +
            "• Experiência com ambos frameworks para iOS e Android",
        "color: #1b1b18; font-size: 12px;"
    );

    // Performance monitoring
    if (window.performance) {
        window.addEventListener("load", () => {
            const perfData = window.performance.timing;
            const pageLoadTime =
                perfData.loadEventEnd - perfData.navigationStart;
            console.log(`⚡ Página carregada em ${pageLoadTime}ms`);
        });
    }
});
