# Sistema de Login - Portfólio

## 🚀 Implementação Concluída

Sistema de autenticação e painel administrativo implementado com sucesso!

## 📋 Características

-   ✅ Sistema de login seguro
-   ✅ Painel administrativo protegido
-   ✅ Edição de informações do portfólio:
    -   Nome
    -   Título/Cargo
    -   Biografia
    -   Skills
-   ✅ Banco de dados MySQL configurado
-   ✅ Interface responsiva e moderna

## 🔐 Credenciais de Acesso

**URL de Login:** `/login`

**Credenciais padrão:**

-   Email: `admin@portfolio.com`
-   Senha: `admin123`

⚠️ **IMPORTANTE:** Altere a senha padrão após o primeiro login!

## 🗄️ Banco de Dados

**Configuração atual:**

-   Servidor: `marceloaugusto.mysql.dbaas.com.br`
-   Banco: `marceloaugusto`
-   Usuário: `marceloaugusto`

## 📂 Estrutura Criada

### Migrations

-   `create_users_table` - Tabela de usuários
-   `create_portfolio_configs_table` - Configurações do portfólio

### Models

-   `User` - Modelo de usuário
-   `PortfolioConfig` - Modelo de configurações do portfólio

### Controllers

-   `AuthController` - Gerencia login/logout
-   `AdminController` - Gerencia painel administrativo
-   `PortfolioController` - Atualizado para usar dados do banco

### Views

-   `auth/login.blade.php` - Página de login
-   `admin/dashboard.blade.php` - Painel administrativo

## 🌐 Rotas Disponíveis

### Públicas

-   `GET /` - Página inicial do portfólio
-   `GET /login` - Página de login
-   `POST /login` - Processar login

### Protegidas (requer autenticação)

-   `GET /admin` - Painel administrativo
-   `PUT /admin/update` - Atualizar configurações do portfólio
-   `POST /logout` - Realizar logout

## 🛠️ Como Usar

### 1. Acessar o Painel Admin

```
1. Acesse: http://seu-dominio.com/login
2. Faça login com as credenciais acima
3. Você será redirecionado para o painel administrativo
```

### 2. Editar Informações

```
1. No painel admin, edite:
   - Nome
   - Título
   - Biografia
   - Skills (adicione/remova conforme necessário)
2. Clique em "Salvar Alterações"
3. As mudanças serão refletidas automaticamente no portfólio
```

### 3. Adicionar Novo Usuário (via terminal)

```bash
php artisan tinker

# Criar novo usuário
$user = new App\Models\User();
$user->name = 'Seu Nome';
$user->email = 'seu@email.com';
$user->password = Hash::make('sua-senha');
$user->save();
```

## 🔄 Comandos Úteis

### Resetar banco de dados

```bash
php artisan migrate:fresh --seed --seeder=AdminUserSeeder
```

### Criar novo usuário admin

```bash
php artisan tinker
User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('senha123')]);
```

### Limpar cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## 🔒 Segurança

1. **Altere a senha padrão** imediatamente após o primeiro acesso
2. **Mantenha o .env seguro** - nunca commite este arquivo
3. **Use senhas fortes** com letras, números e caracteres especiais
4. **Ative HTTPS** em produção

## 📝 Notas Técnicas

-   Laravel 11.x
-   MySQL 8.x
-   PHP 8.2+
-   Bootstrap 5.3
-   Font Awesome 6.4

## 🐛 Troubleshooting

### Erro "could not find driver"

As extensões MySQL foram habilitadas automaticamente. Se o erro persistir:

1. Verifique o php.ini
2. Certifique-se que `extension=pdo_mysql` e `extension=mysqli` estão descomentados
3. Reinicie o servidor

### Não consigo fazer login

1. Verifique se as migrations foram executadas
2. Verifique se o seeder criou o usuário admin
3. Confirme as credenciais: admin@portfolio.com / admin123

### Mudanças não aparecem

1. Limpe o cache: `php artisan cache:clear`
2. Verifique se salvou as alterações no painel admin
3. Recarregue a página com Ctrl+F5

## 📞 Suporte

Em caso de dúvidas ou problemas, verifique:

-   Logs do Laravel: `storage/logs/laravel.log`
-   Configurações do banco: arquivo `.env`
-   Conexão com banco de dados
