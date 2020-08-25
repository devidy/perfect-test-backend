 
 # Instruções
* Com o terminal aberto na pasta do projeto, executar o comando: php -r "file_exists('.env') || copy('.env.example', '.env');"
* Configurar a conexão de banco de dados no arquivo .env
* Com o terminal aberto na pasta do projeto, executar o comando: composer install
* Com o terminal aberto na pasta do projeto, executar o comando: php artisan serve
* Com o terminal aberto na pasta do projeto, executar o comando: php artisan migrate

 # Rotas no Postman
* No readme original ficou aberto a questão de usar o blade que já estava no projeto, então eu criei uma api rest

* CLique no botão abaixo para importar a collection com as rotas postman 

  [![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/2fe490d52546a00405a9)

* As rotas foram criadas no endereço http://localhost:8000, caso você esteja utilizando outro endereço ou porta é substituir as urls
* Caso o link não funcione é só entrar em contato devidy.oliveira@gmail.com que eu gero outro ou envio a collection por email.

## Respostas
1. Http status code 200 "Sucesso"
2. Http status code 201 "Criado com sucesso"

## Exceções

1. ✅ Retorna erro **404** recurso não encontrado
2. ✅ Retorna erro **405** se o verbo http estiver incorreto
3. ✅ Retorna erro **422** se um parametro obrigatório não for passado ou não atenda as regras de validação
4. ✅ Retorna erro **500** erro interno no servidor

## License

[MIT license](https://opensource.org/licenses/MIT).
