# Visão Geral

Este projeto é uma API desenvolvida em Laravel 11 para gerenciar informações sobre as provincias, municipios e comunas de Angola. A aplicação permite criar, editar, listar e deletar provincias, municipios ou comunas. O banco de dados utilizado é o MySQL.
 
## Projecto Api Angola Data
Este documento fornece instruções detalhadas sobre como configurar e executar o Projecto Api Angola Data.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes programas instalados em sua máquina:

 - [Git](https://git-scm.com/)
 - [PHP](https://www.php.net/)
 - [Composer](https://getcomposer.org/)
 - [Laravel](https://laravel.com/docs/11.x/installation/git-scm.com/)

## Tecnologias envolvidas 

 - [Git](https://git-scm.com/)
 - [PHP](https://www.php.net/)
 - [Composer](https://getcomposer.org/)
 - [Laravel](https://laravel.com/docs/11.x/installation/git-scm.com/)

## Passos para Rodar a Aplicação

### 1. Clonar o Projeto do GitHub

1. Abra o terminal.
2. Navegue até o diretório onde você deseja clonar o projeto.
3. Execute o comando abaixo para clonar o repositório:

```sh
git clone https://github.com/Algoritmo2018/Api_Angola_Data.git
```

### 2. Configurar as Chaves no .env

Renomeie o arquivo `.env.example` para `.env`:

```sh
cp .env.example .env
```

### 3. Configurar o Banco de Dados

Abra o arquivo `.env` e configure as seguintes variáveis de ambiente de acordo com seu servidor de banco de dados:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_angola_data
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Instale as dependências do Projecto usando o Composer

```sh
composer install
```

### 5. Gere uma chave de aplicativo Laravel:

```sh
php artisan key:generate
```

### 6. Execute as migrações para criar as tabelas no banco de dados:

```sh
php artisan migrate
```

### 7. Rodar os seeders

```sh
php artisan db:seed
```

### 8. Rodar a aplicação localmente

```sh
php artisan serve
```

## Documentação da Api Angola Data
 
[Acessar doc](https://documenter.getpostman.com/view/32762646/2sAYQgi8k6)
 
