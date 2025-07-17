<!DOCTYPE html>
<style>
  body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
      Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    line-height: 1.6;
    background-color: #f9fafb;
    color: #333;
    margin: 20px auto;
    max-width: 900px;
    padding: 0 15px;
  }
  header, main, section, footer {
    margin-bottom: 2rem;
  }
  h1, h2, h3 {
    color: #2c3e50;
    font-weight: 700;
  }
  h1 {
    font-size: 2.8rem;
    border-bottom: 4px solid #e3342f;
    padding-bottom: 0.4rem;
  }
  h2 {
    font-size: 2rem;
    border-bottom: 2px solid #e3342f;
    padding-bottom: 0.3rem;
    margin-top: 2rem;
  }
  p {
    font-size: 1.1rem;
  }
  ul {
    list-style-type: disc;
    margin-left: 1.5rem;
    margin-top: 0.5rem;
  }
  a {
    color: #e3342f;
    text-decoration: none;
  }
  a:hover {
    text-decoration: underline;
  }
  code {
    background: #f4f4f4;
    border-radius: 4px;
    padding: 2px 6px;
    font-family: monospace;
  }
  pre {
    background: #1e1e1e;
    color: #d4d4d4;
    padding: 1rem;
    border-radius: 6px;
    overflow-x: auto;
    font-size: 0.95rem;
  }
  .badge {
    display: inline-block;
    padding: 0.25em 0.6em;
    margin-right: 0.5em;
    font-size: 0.85rem;
    font-weight: 600;
    line-height: 1;
    color: white;
    background-color: #e3342f;
    border-radius: 0.25rem;
  }
  .center {
    text-align: center;
  }
  img.logo {
    max-width: 300px;
    margin: 1rem 0 2rem;
  }
  footer {
    font-size: 0.9rem;
    color: #777;
    border-top: 1px solid #ddd;
    padding-top: 1rem;
  }
</style>
</head>
<body>

<header class="center">
  <img class="logo" src="https://raw.githubusercontent.com/Victor-Sevegnani/Sistema-de-Loja/main/logo.png" alt="Logo Sistema de Loja" />
  <h1>Sistema de Loja 🛒</h1>
  <p>Um sistema moderno para gestão de lojas, com frontend em Vue.js e backend em PHP.</p>
  <p>
    <a href="https://github.com/Victor-Sevegnani/Sistema-de-Loja" target="_blank" rel="noopener noreferrer" class="badge">GitHub</a>
    <span class="badge">MIT License</span>
  </p>
</header>

<main>
  <section>
    <h2>🚀 Tecnologias</h2>
    <ul>
      <li><strong>Frontend:</strong> Vue.js + Tailwind CSS</li>
      <li><strong>Backend:</strong> PHP (Laravel)</li>
      <li><strong>Banco de Dados:</strong> MySQL ou outro configurado</li>
      <li><strong>Comunicação:</strong> Axios para requisições HTTP</li>
    </ul>
  </section>

  <section>
    <h2>✨ Funcionalidades</h2>
    <ul>
      <li>Cadastro, edição e exclusão de produtos</li>
      <li>Gestão de usuários e permissões</li>
      <li>Login e logout com autenticação segura</li>
      <li>Visualização e controle de vendas e compras</li>
      <li>Feedbacks via mensagens flash</li>
    </ul>
  </section>

  <section>
    <h2>💻 Como rodar o projeto</h2>
    <pre><code># Clone o repositório
git clone https://github.com/Victor-Sevegnani/Sistema-de-Loja.git

# Backend
cd Sistema-de-Loja/backend
composer install
cp .env.example .env
php artisan key:generate
# Configure seu banco no arquivo .env
php artisan migrate
php artisan serve

# Frontend
cd ../frontend
npm install
npm run dev
</code></pre>
    <p>Acesse o frontend no navegador no endereço exibido pelo <code>npm run dev</code> (ex: <code>http://localhost:3000</code>).</p>
  </section>

  <section>
    <h2>🤝 Como contribuir</h2>
    <p>Contribuições são super bem-vindas! Para colaborar:</p>
    <ol>
      <li>Faça um fork do projeto</li>
      <li>Crie uma branch para sua feature (<code>git checkout -b minha-feature</code>)</li>
      <li>Faça commit das suas mudanças (<code>git commit -m "Minha feature"</code>)</li>
      <li>Envie para seu fork (<code>git push origin minha-feature</code>)</li>
      <li>Abra um Pull Request no repositório original</li>
    </ol>
  </section>
</main>

<footer class="center">
  <p>© 2025 Victor Sevegnani - Projeto Sistema de Loja</p>
</footer>

</body>
</html>
