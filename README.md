Sistema de Loja
Sistema de gestão para loja, desenvolvido com Laravel no backend e Vue.js no frontend, para controle de produtos, usuários, vendas e autenticação.

Tecnologias Utilizadas
Backend: Laravel

Frontend: Vue.js + Tailwind CSS

Banco de Dados: MySQL (ou o configurado)

Comunicação: Axios para requisições HTTP

Funcionalidades Principais
Cadastro, edição e remoção de produtos

Gerenciamento de usuários e permissões

Sistema de login/logout com autenticação segura

Visualização e controle de compras e vendas

Feedbacks via mensagens flash

Instalação
Clone o repositório:

bash
Copiar
Editar
git clone https://github.com/Victor-Sevegnani/Sistema-de-Loja.git
Configure o backend:

bash
Copiar
Editar
cd Sistema-de-Loja/backend
composer install
cp .env.example .env
php artisan key:generate
Configure as variáveis do .env (banco, etc) e rode as migrations:

bash
Copiar
Editar
php artisan migrate
Configure o frontend:

bash
Copiar
Editar
cd ../frontend
npm install
npm run dev
Rode o backend localmente:

bash
Copiar
Editar
php artisan serve
Acesse o frontend no navegador (http://localhost:3000 ou conforme configurado).

Contribuindo
Contribuições são muito bem-vindas! Para colaborar:

Faça um fork do projeto

Crie uma branch para sua feature (git checkout -b minha-feature)

Faça commits claros e objetivos

Envie um Pull Request
