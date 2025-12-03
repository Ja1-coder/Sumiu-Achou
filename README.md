## 🚀 Guia de Configuração e Execução do Projeto Laravel (Sumiu\&Achou)

Este guia apresenta os passos básicos para configurar e executar a aplicação Laravel localmente, incluindo as dependências de banco de dados, PHP e Node.js/NPM.

### 📋 Pré-requisitos

Certifique-se de ter instalado em sua máquina:

-   **PHP:** Versão 8.1 ou superior (com extensões comuns como `pdo_mysql`, `mbstring`, `bcmath`).
-   **Composer:** Gerenciador de pacotes PHP.
-   **Node.js e NPM:** Para compilar os recursos de frontend (Tailwind CSS, JavaScript).
-   **Banco de Dados:** MySQL/MariaDB ou similar (XAMPP/WAMP/Docker são recomendados).

### Passo 1: Clonar o Repositório e Instalar Dependências PHP

1.  **Clone o projeto** (se ainda não o fez):

    git clone https://github.com/Ja1-coder/Sumiu-Achou.git
    cd nome-do-projeto

2.  **Instale as dependências do PHP** via Composer:

    composer install

### Passo 2: Configuração do Ambiente (.env)

1.  **Crie o arquivo de ambiente** a partir do modelo:

    cp .env.example .env

2.  **Gere a chave da aplicação:**

    php artisan key:generate

3.  **Configure as credenciais do Banco de Dados** no arquivo `.env`:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=[NOME_DO_SEU_BANCO]
    DB_USERNAME=[SEU_USUARIO_MYSQL]
    DB_PASSWORD=[SUA_SENHA_MYSQL]

### Passo 3: Configuração do Banco de Dados

1.  **Crie o banco de dados** com o nome definido em `DB_DATABASE` (ex: `sumiu_achou`) usando o seu cliente MySQL (phpMyAdmin, DBeaver, MySQL Workbench, etc.).

2.  **Execute as Migrações** para criar as tabelas:

    php artisan migrate

3.  **Execute as Seeds**:

    php artisan db:seed --class=AdminSeeder
    php artisan db:seed --class=ItemTypeSeeder

### Passo 4: Instalação e Compilação dos Recursos de Frontend (Node.js/NPM)

Como o projeto usa Tailwind CSS e Blade/Vite, você precisa instalar as dependências de Node.js e compilar os assets.

1.  **Instale as dependências Node.js/NPM:**

    npm install

2.  **Compile os assets (CSS/JS):**

    -   Para compilar os arquivos uma única vez para produção:

        npm run build

    -   Para desenvolver e ter recompilação automática (modo `watch`):

        npm run dev

### Passo 5: Configuração do Storage Link (Imagens/Arquivos)

Para que as imagens dos itens (como as URLs `asset('storage/...')`) sejam exibidas corretamente, você deve criar um link simbólico entre o diretório `storage/app/public` e o diretório público da sua aplicação.

1.  **Crie o link simbólico:**

    php artisan storage:link

### Passo 6: Execução da Aplicação

1.  **Inicie o servidor local do Laravel:**

    php artisan serve

2.  Abra seu navegador e acesse a URL exibida no terminal (geralmente: `http://127.0.0.1:8000`).
