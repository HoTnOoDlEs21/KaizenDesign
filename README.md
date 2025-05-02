# 🖥️ Caso Prático PHP – KaizenDesign

Este projeto foi desenvolvido como parte final do curso avançado de desenvolvimento web, com o objetivo de consolidar conhecimentos em **PHP**, **MySQL**, **HTML/CSS**, **JavaScript** e boas práticas de estruturação e gestão de conteúdos dinâmicos.

---

## 🧠 Objetivo do Projeto

O KaizenDesign simula um **portal de gestão de projetos** de design e desenvolvimento web, com uma interface simples e prática, onde o utilizador pode:

-   Inserir novos projetos
-   Editar projetos existentes
-   Eliminar projetos
-   Visualizar todos os projetos guardados

---

## 🧱 Tecnologias Utilizadas

-   **PHP** (programação do lado do servidor)
-   **MySQL** (armazenamento de dados e ligação com PHP)
-   **HTML5 & CSS3** (estrutura e apresentação)
-   **JavaScript & jQuery** (interatividade e validações)
-   **Bootstrap** (responsividade)
-   **Font Awesome** (ícones)
-   **PDO** (para ligação segura à base de dados)

---

## 📂 Funcionalidades Desenvolvidas

-   Sistema CRUD completo:
    -   Criar: formulário com validação e envio de imagem
    -   Ler: tabela com listagem de todos os projetos
    -   Atualizar: edição de projetos com atualização da imagem (opcional)
    -   Eliminar: remoção segura com confirmação
-   Upload e validação de imagem (formatos permitidos: .jpg, .jpeg, .png)
-   Validação de dados no lado do cliente (JS) e servidor (PHP)
-   Feedback visual após ações (mensagens de sucesso/erro)
-   Proteção contra SQL Injection (via `prepare` e `bindParam`)
-   Layout responsivo e adaptável

---

## 🖼️ Estrutura do Projeto

kaizen-design/
├── css/
│ └── style.css
├── img/
│ └── (imagens dos projetos)
├── includes/
│ ├── db.php # ligação à base de dados
│ ├── header.php # cabeçalho comum
│ └── footer.php # rodapé comum
├── index.php # listagem de projetos
├── adicionar.php # formulário de inserção
├── editar.php # formulário de edição
├── eliminar.php # script de eliminação
├── upload/ # pasta de imagens enviadas
└── README.md

---

## 🧪 Requisitos para correr localmente

1. Um servidor local como **XAMPP**, **AppServ**, **Laragon** ou **LocalWP**
2. Clonar o projeto ou descompactar numa pasta de servidor (ex: `htdocs/kaizen-design`)
3. Importar a base de dados `kaizen.sql` no `phpMyAdmin`
4. Verificar e ajustar as credenciais de base de dados no ficheiro:
    ```php
    includes/db.php
    ```

## 👤 Autor

José Carlos Gonçalves
GitHub – @HoTnOoDlEs21

## 📝 Notas

Este projeto representa o culminar do módulo de PHP com base de dados e reflete práticas modernas de desenvolvimento web dinâmico. O nome KaizenDesign inspira-se no conceito japonês de melhoria contínua (“kaizen”), aplicado ao design e desenvolvimento web.

## Atualizações

--01/05/2025 02h40
Criado edit_news.php, edit_project.php, get_news_details.php, news.php, projects.php, dete_news.inc.php, delete_project.inc.php, edit_news.inc.php, edit_project.inc.php, insert_news.inc.php, insert_project.inc.php, News.php, Project.php;
Modificado script.js e index.php;
Adicionadas algumas imagens;

--02/05/2025 12h00
Adicionado README.md ao projeto KaizenDesign
