# Bot Telegram
Bot Telegram feito em Node + Typescript e Laravel

## Requerimentos
- Docker e docker-compose instalado

## Instalação
- Faça o clone da aplicação e entre na raiz do projeto.
- Abra um terminal e digite o comando:
```sh
docker-compose up -d
```
e espere os containers subirem.
- Verifique se deu tudo certo executando o comando "docker ps", é necessario que tenha 5 containers, um app, mongodb, redis e nginx.
- Acesse o container da aplicação executando o comando:
```sh
docker exec -it api_bot bash
```
 
#### Execute os comandos abaixo:

```sh
composer install
```
```sh
php artisan key:generate && php artisan migrate
```
```sh
php artisan optimize
```
```sh
/usr/bin/supervisord &
```
Após isso, podemos sair do container e a api estará rodando em:

```sh
127.0.0.1:8081
```

## Endpoints
### /api/chats
 Method: GET
 Descrição: Traz todas as sessões ativas

### /api/chats/{chatId}
 Method: DELETE
 Descrição: Deleta uma sessão ativa

 ## Informações Adicionais
Foi implementado os padrão de projeto Injeção de Dependência, Repository e Services, o código foi implementado com o princípio de POO, e utilizando um Banco de Dados NoSQL, e pub/sub com Redis.

## Bibliotecas usadas
- 