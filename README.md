## Como Usar

Para utilizar a aplicação é necessário instalar o PHP, o Laravel, o Composer, o Vite e o Node;

1. Criar um arquivo .env a partir do .env.example alterando as configurações que se mostrarem necessárias (acesso ao database e url da aplicação)
2. Usar alguma ferramenta para disponibilizar um servidor web e um banco de dados, como o Xampp (no caso, se o Xampp for utilizado, a pasta do projeto deve ser colocada na pasta htdocs do Xampp - criada por padrão em C:/xampp/htdocs no Windows).
3. Se o Laravel não estiver instalado mas o PHP e o Composer estiverem, é possível instalá-lo com o comando "composer global require laravel/installer".
4. Entrar na pasta do projeto e usar o comando "composer install" para instalar as dependências.
5. Usar o comando "php artisan migrate" para criar o banco de dados.
6. Usar o comando "php artisan db:seed --class=DatabaseSeeder" para criar adicionar um administrador ao banco de dados, com o email de acesso "adm@mercado.com" e a senha "12345678".
7. Se o Vite não estiver instalado, usar o comando "npm install vite".
8. Fazer a build da aplicação com o comando "npx vite build".
9. Fazer o deploy com a ferramenta desejada ou usar o comando "npx vite" para visualizar a build de desenvolvimento na url especificada no .env.