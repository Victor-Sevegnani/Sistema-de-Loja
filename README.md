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
    <p>
      Acesse o frontend no navegador no endereço exibido pelo <code>npm run dev</code> (ex: <code>http://localhost:3000</code>).
    </p>
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
