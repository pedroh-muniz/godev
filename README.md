# Sistema de cadastro com pontuação por indicação

## Configure o projeto

Para criar as imagens docker do PHP e do MySql execute o comando abaixo

```
docker-compose up --build
```

Agora execute esses comandos no terminal

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

```
php artisan migrate
```

## Rodar projeto

Para rodar o projeto bastar executar o seguinte comando

```
php artisan serve
```

Depois disso o projeto estara rodando na http://127.0.0.1:8000.