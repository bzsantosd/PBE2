# Pokédex Edition 🦖

Este projeto consiste numa gestão completa de dados via **Banco de Dados (MySQL)**, eliminando a dependência de APIs externas. A aplicação permite visualizar Pokémon lendários pré-definidos e gerir um CRUD completo de criações personalizadas com upload de imagens.

---

## Sobre o Universo

O sistema já vem populado com três entidades lendárias únicas, cada uma com a sua própria história e mecânicas de combate:

* **🌑 Umbrarex:**
    O terror dos estrategistas pela sua natureza reativa e furtiva. Ele funde-se à sombra do adversário para observar o seu comportamento e, ao emergir, replica os ataques do inimigo com força sombria amplificada, agindo como um espelho psicológico.

* **⚓ Aquavant:**
    Mestre das artes marciais subaquáticas que treina nas correntes mais fortes do oceano. Consegue endurecer a água ao redor dos punhos, criando lâminas cortantes. Utiliza danças de combate para gerar redemoinhos e proteger o seu território.

* **🕳️ Riftor:**
    Uma anomalia que desafia as leis do espaço. Move-se instantaneamente através de fendas roxas na realidade, tornando-se intocável ao desaparecer no momento do impacto. Habita ruínas antigas e coleciona relíquias de outras dimensões.

---

## 🛠️ Tecnologias Utilizadas

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
* **`database/seeders/PokemonFixoSeeder.php`**: Script para popular o banco com os 3 Pokémon Lendários iniciais (Umbrarex, Aquavant e Riftor).
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
    DB_DATABASE=nome_da_sua_base
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
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

* **Diferenciação de Registos**: Foi utilizado um campo booleano `is_fixo` no banco para separar o conteúdo lendário (estático) do conteúdo criado pelo utilizador.
* **Segurança**: Validação de formulários no Controller para garantir que apenas imagens válidas sejam enviadas e campos obrigatórios sejam preenchidos.