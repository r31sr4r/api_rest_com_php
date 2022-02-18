# CRUD de Usuários -> API REST em PHP

Descrição do projeto

- API desenvolvida em PHP;
- API Stateless;
- A API utiliza a seguinte versão do framework Symfony: 5.3.10;
- As informações do usuário persistem no banco de dados MySql;
- Está sendo utilizado o ORM Doctrine.

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

Consulte **Implantação** para saber como implantar o projeto.

### 📋 Pré-requisitos

- Possuir o PHP Instalado;
- Possuir Banco de dados Mysql/MariaDB Instalado;
- Possuir o framework Symfony instalado;
- Possuir o ORM Doctrine instalado;
- Possuir o Composer instalado.

### 🔧 Instalação

Abaixo será apresentado um breve tutorial para instalação dos pré-requisitos. Neste caso, as aplicações serão instaladas no SO Debian GNU/Linux 11 "Bullseye", porém podem ser instaladas em outros sistemas operacionais.

Instalando o PHP

```
$ sudo apt install php
```

Instalando pacotes necessários para o Composer:

```
$ sudo apt install wget php-cli php-zip unzip
```

Baixando o instalador do Composer e instalando:

```
$ wget -O composer-setup.php https://getcomposer.org/installer
$ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
$ sudo composer self-update  
``` 
Para a instalação do Mysql/MariaDB, sugerimos seguir os passos listados no link abaixo:
```
https://www.digitalocean.com/community/tutorials/how-to-install-the-latest-mysql-on-debian-10
```

Instalando o Symfony

```
$ wget https://get.symfony.com/cli/installer -O - | bash
```

Instalando o ORM Doctrine

```
$ composer require symfony/orm-pack
```

## ⚙️ Executando a API

Para os testes, foi utilizado o servidor interno do PHP. Para subir o servidor (na porta 8080 por exemplo), utilizamos o seguinte comando:

```
$ php -S localhost:8080 -t public/
```

Antes de utilizar a API, é preciso criar o banco de dados, realizar as "migrations"

Para tais ações, iremos executar os comandos abaixo (dentro do diretório do projeto):
```
$ php bin/console doctrine:database:create

$ php bin/console make:migrations

$ php bin/console doctrine:migrations:migrate
```

Será necessário fim criar um usuário inicial no banco de dados.
Para isso utilizaremos de "Fixtures", executando os comandos abaixo:
```
$ composer require orm-fixtures

$ php bin/console doctrine:fixtures:load
```

O usuário criado é o seguinte:
```
username: usrpromobit
senha: 123456
```

### 🔩 Iniciando e utilizando a API

Para testes da API, foi utilizado a aplicação PostMan.

Com o servidor PHP rodando na porta 8080, podemos acessar a funcionalidade de Login através da rota abaixo.
```
http://localhost:8080/login
```
Tal rota irá aceitar o método POST, e o formato para envio da requisição será o seguinte:
```
{
    "usuario": "usrpromobit",
    "senha": "123456"
}
```

O retorno será o token de acesso para as demais funcionalidades do CRUD.

O token deve ser passado no cabeçalho da requisição com a key "Authorization" e o value: "Beaer " + token.

As funcionalidadades estão acessiveis pelas seguintes rotas:

- Cadastro de Usuário (método POST)
```
/usuarios
```
Formato da requisição:
```
{
"nome": "Nome completo do usuário",
"username": "username para o usuário",
"cpf": "cpf do usuário",
"rg": "rg do usuário",
"email": "e-mail do usuário",
"password": "senha do usuário"
}
```

- Listagem de usuaŕios (método GET)
```
/usuarios
```
Obs: esta requisição aceita parâmetros de ordenação e paginação via query string. Exemplo:
```
?sort[nome]=ASC&sort[cpf]=DESC&page=1&itensPorPagina=3
```

- Listagem/detalhamento de um usuário específico (método GET)
```
/usuarios/[id do usuário]
```

- Atualização de um usuário (método PUT)
```
/usuarios/[id do usuário]
```
Obs.: Na atualizaçao do usuario, passar o password como vazio. A funcionalidade de atualizar senha será desenvolvida de forma separada;


Formato da requisição:
```
{
"nome": "Nome completo do usuário",
"username": "username para o usuário",
"cpf": "cpf do usuário",
"rg": "rg do usuário",
"email": "e-mail do usuário",
"password": "senha do usuário"
}
```

- Exclusão de um usuário (método DELETE)
```
/usuarios/[id do usuário]
```

- Recuperação de senha
```
/recuperarsenha
```

Obs.: Esta rota não necessita de autenticação via token

## 🛠️ Construído com

* [PHP](https://php.net/) - Linguagem open source de script open source de uso geral
* [Symfony](https://symfony.com/) - O framework utilizado
* [Doctrine](https://www.doctrine-project.org/) - ORM : Object Relational Mapper
* [Composer](https://getcomposer.org/) - Gerenciador de dependências para PHP
* [MariaDB](https://mariadb.org/) - Banco de dados relacional

## 📌 Versão

v0.1.1

---
⌨️ por [Rafael Reis](https://github.com/r31sr4r)
