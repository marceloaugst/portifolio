@extends('layouts.app')

@section('title', $name . ' - Portfólio')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fas fa-code"></i> {{ $title }}
        </div>
        <h1>Olá, eu sou <span>{{ $name }}</span></h1>
        <p class="hero-subtitle">
            Desenvolvedor Full Stack apaixonado por criar soluções inovadoras com Laravel, Golang e JavaScript
        </p>
        <div class="hero-buttons">
            <a href="#contact" class="btn btn-primary">
                <i class="fas fa-envelope"></i> Entre em Contato
            </a>
            <a href="#skills" class="btn btn-secondary">
                <i class="fas fa-laptop-code"></i> Ver Skills
            </a>
        </div>
        <div class="hero-tech-badge">
            <i class="fab fa-laravel"></i>
            <span>Desenvolvido com Laravel & Blade</span>
        </div>
    </div>
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- About Section -->
<section class="section" id="about">
    <div class="container">
        <h2 class="section-title">Sobre <span>Mim</span></h2>
        <p class="section-subtitle">Conheça um pouco mais sobre minha trajetória e paixão por desenvolvimento</p>

        <div class="about-content">
            <div class="about-image-placeholder">
                <img src="{{ asset('img/profile.jpeg') }}" alt="{{ $name }}">
            </div>
            <div class="about-text">
                <h3>{{ $title }}</h3>
                <p>{{ $bio }}</p>
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number">8+</div>
                        <div class="stat-label">Tecnologias</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">∞</div>
                        <div class="stat-label">Curiosidade</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Dedicação</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="section" id="skills">
    <div class="container">
        <h2 class="section-title">Minhas <span>Skills</span></h2>
        <p class="section-subtitle">Tecnologias e ferramentas que domino para criar soluções completas</p>

        <div class="skills-grid">
            <!-- Backend -->
            <div class="skill-category">
                <h3 class="skill-category-title">
                    <i class="fas fa-server" style="color: #FF2D20;"></i>
                    Backend
                </h3>
                <div class="skill-items">
                    @foreach($skills['backend'] as $skill)
                    <a href="{{ $skill['url'] }}" target="_blank" class="skill-item">
                        <div class="skill-icon"
                            style="background: {{ $skill['color'] }}20; color: {{ $skill['color'] }};">
                            <i class="{{ $skill['icon'] }}"></i>
                        </div>
                        <span class="skill-name">{{ $skill['name'] }}</span>
                        <i class="fas fa-external-link-alt"
                            style="margin-left: auto; font-size: 0.7rem; opacity: 0;"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Mobile -->
            <div class="skill-category">
                <h3 class="skill-category-title">
                    <i class="fas fa-mobile-alt" style="color: #02569B;"></i>
                    Mobile Development
                </h3>
                <div class="skill-items">
                    @foreach($skills['mobile'] as $skill)
                    <a href="{{ $skill['url'] }}" target="_blank" class="skill-item">
                        <div class="skill-icon"
                            style="background: {{ $skill['color'] }}20; color: {{ $skill['color'] }};">
                            <i class="{{ $skill['icon'] }}"></i>
                        </div>
                        <span class="skill-name">{{ $skill['name'] }}</span>
                        <i class="fas fa-external-link-alt"
                            style="margin-left: auto; font-size: 0.7rem; opacity: 0;"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Frontend -->
            <div class="skill-category">
                <h3 class="skill-category-title">
                    <i class="fas fa-palette" style="color: #F7DF1E;"></i>
                    Frontend
                </h3>
                <div class="skill-items">
                    @foreach($skills['frontend'] as $skill)
                    <a href="{{ $skill['url'] }}" target="_blank" class="skill-item">
                        <div class="skill-icon"
                            style="background: {{ $skill['color'] }}20; color: {{ $skill['color'] }};">
                            <i class="{{ $skill['icon'] }}"></i>
                        </div>
                        <span class="skill-name">{{ $skill['name'] }}</span>
                        <i class="fas fa-external-link-alt"
                            style="margin-left: auto; font-size: 0.7rem; opacity: 0;"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Database -->
            <div class="skill-category">
                <h3 class="skill-category-title">
                    <i class="fas fa-database" style="color: #336791;"></i>
                    Banco de Dados
                </h3>
                <div class="skill-items">
                    @foreach($skills['database'] as $skill)
                    <a href="{{ $skill['url'] }}" target="_blank" class="skill-item">
                        <div class="skill-icon"
                            style="background: {{ $skill['color'] }}20; color: {{ $skill['color'] }};">
                            <i class="{{ $skill['icon'] }}"></i>
                        </div>
                        <span class="skill-name">{{ $skill['name'] }}</span>
                        <i class="fas fa-external-link-alt"
                            style="margin-left: auto; font-size: 0.7rem; opacity: 0;"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section" id="contact">
    <div class="container">
        <h2 class="section-title">Entre em <span>Contato</span></h2>
        <p class="section-subtitle">Vamos conversar sobre seu próximo projeto ou oportunidade</p>

        <div class="contact-content">
            <div class="contact-info">
                <h3>Vamos trabalhar juntos!</h3>
                <p>Estou sempre aberto a discutir novos projetos, ideias criativas ou oportunidades para fazer parte de
                    suas visões.</p>

                <div class="contact-links">
                    <a href="{{ $social['github'] }}" class="contact-link" target="_blank">
                        <i class="fab fa-github"></i>
                        <div>
                            <strong>GitHub</strong>
                            <p style="margin: 0; font-size: 0.9rem;">Confira meus projetos</p>
                        </div>
                    </a>
                    <a href="{{ $social['linkedin'] }}" class="contact-link" target="_blank">
                        <i class="fab fa-linkedin"></i>
                        <div>
                            <strong>LinkedIn</strong>
                            <p style="margin: 0; font-size: 0.9rem;">Conecte-se comigo</p>
                        </div>
                    </a>
                    <a href="mailto:{{ $social['email'] }}" class="contact-link">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <p style="margin: 0; font-size: 0.9rem;">{{ $social['email'] }}</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="contact-form">
                <form id="contact-form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" placeholder="Seu nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea id="message" name="message" placeholder="Sua mensagem..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-paper-plane"></i> <span>Enviar Mensagem</span>
                    </button>
                    <div id="form-message"
                        style="margin-top: 15px; display: none; padding: 12px; border-radius: 8px; text-align: center; font-size: 0.95rem;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // ============================================
    // DEMONSTRAÇÃO DE SKILLS EM JAVASCRIPT
    // ============================================

    /**
     * Classe para gerenciar tema Dark/Light Mode
     * Demonstra: Classes ES6, LocalStorage, DOM Manipulation
     */
    class ThemeManager {
        constructor() {
            this.theme = localStorage.getItem('theme') || 'system';
            this.init();
        }

        init() {
            this.applyTheme();
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (this.theme === 'system') {
                    this.applyTheme();
                }
            });
        }

        applyTheme() {
            const isDark = this.theme === 'dark' ||
                          (this.theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            document.documentElement.classList.toggle('dark', isDark);
        }

        toggle() {
            this.theme = this.theme === 'dark' ? 'light' : 'dark';
            localStorage.setItem('theme', this.theme);
            this.applyTheme();
        }
    }

    /**
     * Efeito de digitação animado
     * Demonstra: Promises, async/await, Animações
     */
    class TypingEffect {
        constructor(element, texts, speed = 100) {
            this.element = element;
            this.texts = texts;
            this.speed = speed;
            this.currentIndex = 0;
        }

        async type(text) {
            for (let i = 0; i <= text.length; i++) {
                this.element.textContent = text.substring(0, i);
                await new Promise(resolve => setTimeout(resolve, this.speed));
            }
        }

        async delete() {
            const text = this.element.textContent;
            for (let i = text.length; i >= 0; i--) {
                this.element.textContent = text.substring(0, i);
                await new Promise(resolve => setTimeout(resolve, this.speed / 2));
            }
        }

        async start() {
            while (true) {
                await this.type(this.texts[this.currentIndex]);
                await new Promise(resolve => setTimeout(resolve, 2000));
                await this.delete();
                this.currentIndex = (this.currentIndex + 1) % this.texts.length;
            }
        }
    }

    /**
     * Sistema de partículas interativas
     * Demonstra: Canvas API, requestAnimationFrame, Event Listeners
     */
    class ParticleSystem {
        constructor() {
            this.particles = [];
            this.maxParticles = 50;
            this.init();
        }

        init() {
            document.addEventListener('mousemove', (e) => {
                this.createParticle(e.clientX, e.clientY);
            });
            this.animate();
        }

        createParticle(x, y) {
            if (this.particles.length >= this.maxParticles) {
                this.particles.shift();
            }

            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.cssText = `
                position: fixed;
                left: ${x}px;
                top: ${y}px;
                width: 4px;
                height: 4px;
                background: #F53003;
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                opacity: 1;
            `;

            document.body.appendChild(particle);

            this.particles.push({
                element: particle,
                vx: (Math.random() - 0.5) * 2,
                vy: (Math.random() - 0.5) * 2,
                life: 1,
                x: x,
                y: y
            });
        }

        animate() {
            this.particles = this.particles.filter(particle => {
                particle.x += particle.vx;
                particle.y += particle.vy;
                particle.life -= 0.02;

                particle.element.style.left = particle.x + 'px';
                particle.element.style.top = particle.y + 'px';
                particle.element.style.opacity = particle.life;

                if (particle.life <= 0) {
                    particle.element.remove();
                    return false;
                }
                return true;
            });

            requestAnimationFrame(() => this.animate());
        }
    }

    /**
     * Contador animado para estatísticas
     * Demonstra: Intersection Observer, Animações numéricas
     */
    class AnimatedCounter {
        constructor(element, target, duration = 2000) {
            this.element = element;
            this.target = target;
            this.duration = duration;
            this.observer = null;
        }

        animate() {
            const start = 0;
            const increment = this.target / (this.duration / 16);
            let current = start;

            const updateCounter = () => {
                current += increment;
                if (current < this.target) {
                    this.element.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    this.element.textContent = this.target;
                }
            };

            updateCounter();
        }

        observe() {
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animate();
                        this.observer.unobserve(this.element);
                    }
                });
            });
            this.observer.observe(this.element.parentElement);
        }
    }

    /**
     * Gerenciador de scroll suave e navegação
     * Demonstra: Event delegation, History API
     */
    class SmoothScroll {
        constructor() {
            this.init();
        }

        init() {
            document.addEventListener('click', (e) => {
                const anchor = e.target.closest('a[href^="#"]');
                if (!anchor) return;

                const href = anchor.getAttribute('href');
                if (href === '#') return;

                const target = document.querySelector(href);
                if (!target) return;

                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                history.pushState(null, null, href);
            });
        }
    }

    /**
     * Sistema de validação de formulário
     * Demonstra: Regex, Validação em tempo real, UX
     */
    class FormValidator {
        constructor(form) {
            this.form = form;
            this.rules = {
                email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                name: /^[a-zA-ZÀ-ÿ\s]{2,}$/
            };
            this.init();
        }

        init() {
            const inputs = this.form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', () => this.validateField(input));
                input.addEventListener('input', () => this.clearError(input));
            });
        }

        validateField(field) {
            const value = field.value.trim();
            const name = field.name;

            if (!value) {
                this.showError(field, 'Este campo é obrigatório');
                return false;
            }

            if (this.rules[name] && !this.rules[name].test(value)) {
                const messages = {
                    email: 'Por favor, insira um email válido',
                    name: 'Por favor, insira um nome válido'
                };
                this.showError(field, messages[name]);
                return false;
            }

            this.clearError(field);
            return true;
        }

        showError(field, message) {
            this.clearError(field);
            field.style.borderColor = '#ef4444';
            const error = document.createElement('small');
            error.className = 'field-error';
            error.style.cssText = 'color: #ef4444; font-size: 0.85rem; margin-top: 5px; display: block;';
            error.textContent = message;
            field.parentElement.appendChild(error);
        }

        clearError(field) {
            field.style.borderColor = '';
            const error = field.parentElement.querySelector('.field-error');
            if (error) error.remove();
        }

        validate() {
            const inputs = this.form.querySelectorAll('input, textarea');
            let isValid = true;
            inputs.forEach(input => {
                if (!this.validateField(input)) isValid = false;
            });
            return isValid;
        }
    }

    // ============================================
    // INICIALIZAÇÃO
    // ============================================

    // Inicializa Theme Manager
    window.themeManager = new ThemeManager();

    // Smooth Scroll
    new SmoothScroll();

    // Inicializa Sistema de Partículas (hover effect)
    new ParticleSystem();

    // Efeito de digitação no título
    const heroTitle = document.querySelector('.hero h1 span');
    if (heroTitle) {
        const originalName = heroTitle.textContent;
        heroTitle.textContent = '';
        new TypingEffect(heroTitle, [originalName, 'Full Stack Developer', 'Laravel Expert', 'Flutter & React Native']).start();
    }

    // Add animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.skill-category, .contact-link, .stat-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Contador animado para estatísticas
    document.querySelectorAll('.stat-number').forEach(el => {
        const text = el.textContent.trim();
        if (text.includes('+')) {
            const num = parseInt(text);
            if (!isNaN(num)) {
                el.textContent = '0';
                new AnimatedCounter(el, num).observe();
            }
        }
    });

    // Handle contact form submission com validação
    const contactForm = document.getElementById('contact-form');
    const formMessage = document.getElementById('form-message');
    const submitBtn = contactForm.querySelector('button[type="submit"]');
    const submitText = submitBtn.querySelector('span');

    // Inicializa validador de formulário
    const formValidator = new FormValidator(contactForm);

    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Valida formulário antes de enviar
        if (!formValidator.validate()) {
            formMessage.style.display = 'block';
            formMessage.style.background = 'rgba(239, 68, 68, 0.1)';
            formMessage.style.color = '#ef4444';
            formMessage.style.border = '1px solid rgba(239, 68, 68, 0.3)';
            formMessage.innerHTML = '<i class="fas fa-exclamation-circle"></i> Por favor, corrija os erros no formulário.';

            setTimeout(() => {
                formMessage.style.display = 'none';
            }, 5000);
            return;
        }

        const formData = new FormData(contactForm);
        const originalText = submitText.textContent;

        try {
            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Enviando...';

            const response = await fetch('{{ route("contact.send") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                // Success message
                formMessage.style.display = 'block';
                formMessage.style.background = 'rgba(34, 197, 94, 0.1)';
                formMessage.style.color = '#22c55e';
                formMessage.style.border = '1px solid rgba(34, 197, 94, 0.3)';
                formMessage.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;

                // Reset form
                contactForm.reset();
                submitBtn.disabled = false;
                submitText.textContent = originalText;

                // Hide message after 5 seconds
                setTimeout(() => {
                    formMessage.style.display = 'none';
                }, 5000);
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            // Error message
            formMessage.style.display = 'block';
            formMessage.style.background = 'rgba(239, 68, 68, 0.1)';
            formMessage.style.color = '#ef4444';
            formMessage.style.border = '1px solid rgba(239, 68, 68, 0.3)';
            formMessage.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + (error.message || 'Erro ao enviar a mensagem.');

            submitBtn.disabled = false;
            submitText.textContent = originalText;

            // Hide message after 5 seconds
            setTimeout(() => {
                formMessage.style.display = 'none';
            }, 5000);
        }
    });

    // ============================================
    // EASTER EGG PARA RECRUTADORES
    // ============================================
    console.log(
        '%c👋 Olá, Recrutador!',
        'color: #F53003; font-size: 24px; font-weight: bold;'
    );
    console.log(
        '%cSe você está lendo isso, aqui está um Easter Egg! 🎉\n' +
        'Este portfólio demonstra skills em:\n' +
        '• JavaScript ES6+ (Classes, Promises, async/await)\n' +
        '• DOM Manipulation & Event Listeners\n' +
        '• Canvas API & Animations\n' +
        '• Intersection Observer API\n' +
        '• LocalStorage & History API\n' +
        '• Form Validation & UX\n' +
        '• Laravel + Blade Templates',
        'color: #1b1b18; font-size: 14px;'
    );
    console.log(
        '%c📱 Mobile Development Stack:',
        'color: #F53003; font-size: 16px; font-weight: bold; margin-top: 10px;'
    );
    console.log(
        '%c• Flutter (Dart) - Cross-platform mobile apps\n' +
        '• React Native - JavaScript mobile development\n' +
        '• Experiência com ambos frameworks para iOS e Android',
        'color: #1b1b18; font-size: 12px;'
    );

    // Performance monitoring
    if (window.performance) {
        window.addEventListener('load', () => {
            const perfData = window.performance.timing;
            const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
            console.log(`⚡ Página carregada em ${pageLoadTime}ms`);
        });
    }
</script>
@endpush