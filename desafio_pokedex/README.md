# Pokédex Edition 🦖

Este projeto em uma gestão completa de dados via **Banco de Dados (MySQL)**, eliminando a dependência de APIs externas. A aplicação permite visualizar Pokémon lendários pré-definidos e gerir um CRUD completo de criações personalizadas com upload de imagens.

---

## Tecnologias Utilizadas

* **Framework:** Laravel 11
* **Linguagem:** PHP 8.2+
* **Banco de Dados:** MySQL
* **Frontend:** Tailwind CSS (via CDN)
* **Ícones/Fontes:** Font Awesome & Google Fonts

---

## 🏗️ Arquitetura e 📂 Estrutura de Pastas

* **`app/Http/Controllers/PokemonController.php`**: Contém a lógica de controlo (listagem, criação, edição e exclusão).
* **`app/Models/Pokemon.php`**: Classe que representa a tabela de Pokémons (`$fillable`).
* **`database/migrations/`**: Define a estrutura da tabela no MySQL (nome, tipo, ataque, foto, descrição).
* **`database/seeders/PokemonFixoSeeder.php`**: Script para popular o banco com os 3 Pokémon Lendários iniciais.
* **`resources/views/`**:
    * `pokedex.blade.php`: Interface principal e galeria de cards.
    * `edit.blade.php`: Formulário para edição de dados.
    * `welcome.blade.php`: Página inicial padrão.
* **`routes/web.php`**: Definição das rotas (URLs) do sistema.
* **`public/img/`**: Armazenamento de fotos estáticas e imagens enviadas pelos utilizadores.

---

## 🚀 Funcionalidades Implementadas

### 🔹 Gestão de Dados (CRUD)
* **Create (Criar)**: Cadastro de Pokémon com nome, tipo, ataque, descrição e anexo de foto.
* **Read (Ler)**: Exibição de duas listas: **Lendários (Fixos)** e **Minhas Criações (Dinâmicos)**.
* **Update (Atualizar)**: Edição completa de informações e substituição de imagem.
* **Delete (Excluir)**: Remoção de registos com alerta de confirmação e limpeza de ficheiros.

### 🔹 Tratamento de Imagens
Utilização do **Storage Link** do Laravel para garantir que os uploads sejam armazenados de forma organizada e fiquem acessíveis publicamente através de URLs seguras.

---

## ⚙️ Como Instalar e Rodar

Siga os passos abaixo para configurar o projeto localmente:

1.  **Clonar o repositório:**
    ```bash
    git clone <url-do-repositorio>
    cd pokedex-edition
    ```

2.  **Instalar as dependências:**
    ```bash
    composer install
    ```

3.  **Configurar o Ambiente (.env):**
    Copie o ficheiro `.env.example` para `.env` e ajuste as credenciais do MySQL:
    ```env
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=SenaiSP
    ```

4.  **Preparar o Banco de Dados (Migrations + Seeders):**
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Criar Link de Armazenamento:**
    ```bash
    php artisan storage:link
    ```

6.  **Iniciar o Servidor:**
    ```bash
    php artisan serve
    ```
    Aceda a: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📝 Notas 

* **Diferenciação de Registos**: Foi utilizado um campo booleano `is_fixo` no banco para separar conteúdo do sistema de conteúdo do utilizador.
* **Segurança**: Validação de formulários no Controller para garantir que apenas imagens válidas sejam enviadas e campos obrigatórios sejam preenchidos.