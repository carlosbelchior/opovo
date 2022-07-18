# GRUPO O POVO - CARLOS BELCHIOR
Software Grupo O Povo - Por Carlos Belchior.

## Tecnologias
As tecnologias abaixo descritas foram utilizadas para desenvolver esse projeto.

- *Laravel 9.x*
- *MySQL*

## Configuração do projeto
Este é basicamente um projeto laravel. Para executar se faz necessário seguir os requisitos do framework. É EXTREMAMENTE recomendado que use docker para executar esta aplicação. Você pode instalr o Docker seguindo as instruções do link a seguir para [obter o docker](https://docs.docker.com/engine/install/).

As próximas sessões irão fornecer instruções de como configurar e executar a aplicação em um container Docker.

### Iniciando
Para configurar seu container docker execute o comando abaixo:

```bash
docker-compose up --build -d
```

Após criado o container docker você pode acessar o serviço PHP do Docker com o comando abaixo:
```bash
docker-compose exec php /bin/bash
```

O container docker será executado com imagens nginx, mysql e PHP.

#### Arquivos de configuração
Faça uma cópia do arquivo `.env.example`para `.env` e informe as variaveis de configuração conforme informado na documentação do Laravel no link a [seguir](https://laravel.com/docs/9.x/configuration).

IMPORTANTE: As configurações de acesso padrão do banco de dados são:
- host: mysql
- database: default
- user: root
- password: admin

#### Instalando dependencias

Execute os comandos abaixo para instalar todas as dependencias do projeto:

Na imagem PHP do Docker execute o comando abaixo:

```bash
composer install 
```

#### Gerar chave laravel
No seu container docker execute o comando abaixo:

```bash
php artisan key:generate 
```

#### Executando as migrations
Na imagem PHP do Docker e execute as migrations para configurar seu banco de dados:

```bash
php artisan migrate
```

#### Executando as seeds
Se quiser popular seu banco de dados com informações ficticias execute as seeds para criar os dados:

```bash
php artisan db:seed
```

## Rotas da API

#### IMPORTANTE: Todas as rotas (salvo login e registro) são protegidas por meio de um JWT com expiração de 5 MINUTOS, o token será informado após o login.

Para registrar um novo jornalista:
```
Method: POST
URL: /api/produtos/todos
```
Data body:
- 'nome' => 'required|min:3',
- 'sobrenome' => 'required|min:3',
- 'email' => 'required|email|unique:App\Models\Jornalista,email',
- 'senha' => 'required|min:5'

----- 

Para logar:
```
Method: POST
URL: /api/login
```
Data body:
- 'email' => 'required|email'
- 'password' => 'required|'

Informações da conta:
```
Method: GET
URL: /api/me
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

----- 

### Tipos de noticia

Tipos de noticia do jornalista logado:
```
Method: GET
URL: /api/type/me
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

----- 

Cadastrar tipo de noticia:
```
Method: POST
URL: /api/type/create
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

Data body:
- 'nome' => 'required|min:3'

----- 

Atualizar tipo de noticia:
```
Method: POST
URL: /api/type/update/ID_TIPO_DE_NOTICIA
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

Data body:
- 'nome' => 'required|min:3'

----- 

Deletar tipo de noticia:
```
Method: GET
URL: /api/type/delete/ID_TIPO_DE_NOTICIA
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

----- 

### Noticia

Noticias do jornalista logado:
```
Method: GET
URL: /api/news/me
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

----- 

Cadastrar noticia:
```
Method: POST
URL: /api/news/create
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

Data body:
- 'id_tipo_noticia' => 'required|exists:App\Models\NoticiaTipo,id',
- 'titulo' => 'required|min:3',
- 'descricao' => 'required|min:5',
- 'corpo' => 'required|min:5',
- 'imagem' => 'nullable|url',

----- 

Atualizar noticia:
```
Method: POST
URL: /api/news/update/ID_NOTICIA
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"

Data body:
- 'id_tipo_noticia' => 'required|exists:App\Models\NoticiaTipo,id',
- 'titulo' => 'required|min:3',
- 'descricao' => 'required|min:5',
- 'corpo' => 'required|min:5',
- 'imagem' => 'nullable|url',

----- 

Deletar noticia:
```
Method: GET
URL: /api/news/delete/ID_NOTICIA
```
Data header:
- "Authorization" : "Bearer SEU_TOKEN_AQUI"
