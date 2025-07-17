<p align="center"> <a href="https://laravel.com" target="_blank"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"> </a> </p> <p align="center"> <a href="https://github.com/Victor-Sevegnani/Sistema-de-Loja/actions"><img src="https://github.com/Victor-Sevegnani/Sistema-de-Loja/workflows/CI/badge.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg" alt="License"></a> </p>
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
