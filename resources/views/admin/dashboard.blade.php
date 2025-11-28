<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel Administrativo</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    </head>

    <body>
        <nav class="navbar navbar-dark">
            <div class="container">
                <span class="navbar-brand h1 mb-0">
                    <i class="fas fa-user-shield"></i> Painel Administrativo
                </span>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-white">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container py-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Perfil</h3>
                            <p>{{ $config->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Cargo</h3>
                            <p>{{ $config->title }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Skills</h3>
                            <p>{{ is_array($config->skills) ? count($config->skills) : 0 }} cadastradas</p>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Editar Informações do Portfólio
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Seção: Informações Pessoais -->
                        <div class="section-divider">
                            <h5><i class="fas fa-id-card"></i> Informações Pessoais</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i> Nome Completo
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $config->name) }}"
                                    placeholder="Seu nome completo" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">
                                    <i class="fas fa-briefcase"></i> Título Profissional
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $config->title) }}"
                                    placeholder="Ex: Desenvolvedor Full Stack" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Seção: Biografia -->
                        <div class="section-divider">
                            <h5><i class="fas fa-align-left"></i> Sobre Você</h5>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">
                                <i class="fas fa-pen"></i> Biografia
                            </label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="6"
                                placeholder="Conte um pouco sobre sua trajetória profissional..." required>{{ old('bio', $config->bio) }}</textarea>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> Descreva sua experiência, habilidades e objetivos
                                profissionais
                            </small>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Seção: Skills -->
                        <div class="section-divider">
                            <h5><i class="fas fa-star"></i> Habilidades Técnicas</h5>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-code"></i> Lista de Skills
                            </label>
                            <div id="skills-container">
                                @if (old('skills'))
                                    @foreach (old('skills') as $index => $skill)
                                        <div class="skill-item">
                                            <i class="fas fa-grip-vertical drag-handle"></i>
                                            <input type="text" class="form-control form-control-sm"
                                                name="skills[]" value="{{ $skill }}"
                                                placeholder="Ex: Laravel, JavaScript, Python...">
                                            <button type="button" class="btn-remove" onclick="removeSkill(this)"
                                                title="Remover skill">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @elseif($config->skills && is_array($config->skills))
                                    @foreach ($config->skills as $skill)
                                        <div class="skill-item">
                                            <i class="fas fa-grip-vertical drag-handle"></i>
                                            <input type="text" class="form-control form-control-sm"
                                                name="skills[]"
                                                value="{{ is_string($skill) ? $skill : json_encode($skill) }}"
                                                placeholder="Ex: Laravel, JavaScript, Python...">
                                            <button type="button" class="btn-remove" onclick="removeSkill(this)"
                                                title="Remover skill">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-add-skill btn-sm mt-2" onclick="addSkill()">
                                <i class="fas fa-plus"></i> Adicionar Nova Skill
                            </button>
                            <small class="d-block text-muted mt-2">
                                <i class="fas fa-lightbulb"></i> Dica: Adicione suas principais tecnologias e
                                ferramentas
                            </small>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="form-actions">
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <i class="fas fa-eye"></i> Visualizar Portfólio
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function addSkill() {
                const container = document.getElementById('skills-container');
                const skillItem = document.createElement('div');
                skillItem.className = 'skill-item';
                skillItem.innerHTML = `
                <i class="fas fa-grip-vertical drag-handle"></i>
                <input type="text" class="form-control form-control-sm"
                       name="skills[]" placeholder="Ex: Laravel, JavaScript, Python...">
                <button type="button" class="btn-remove" onclick="removeSkill(this)" title="Remover skill">
                    <i class="fas fa-times"></i>
                </button>
            `;
                container.appendChild(skillItem);

                // Foco no input recém-criado
                skillItem.querySelector('input').focus();
            }

            function removeSkill(button) {
                const skillItem = button.closest('.skill-item');
                skillItem.style.opacity = '0';
                skillItem.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    skillItem.remove();
                }, 300);
            }

            // Animação de entrada para skills existentes
            document.addEventListener('DOMContentLoaded', function() {
                const skills = document.querySelectorAll('.skill-item');
                skills.forEach((skill, index) => {
                    setTimeout(() => {
                        skill.style.opacity = '1';
                        skill.style.transform = 'translateX(0)';
                    }, index * 50);
                });
            });
        </script>
    </body>

</html>
