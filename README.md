 
 # Instruções
* Com o terminal aberto na pasta do projeto, executar o comando: php -r "file_exists('.env') || copy('.env.example', '.env');"
* Configurar a conexão de banco de dados no arquivo .env
* Com o terminal aberto na pasta do projeto, executar o comando: composer install
* Com o terminal aberto na pasta do projeto, executar o comando: php artisan serve

 # Rotas no Postman
* link para importar rotas no postman https://www.getpostman.com/collections/2fe490d52546a00405a9
* Caso o link não funcione é só entrar em contato devidy.oliveira@gmail.com que eu gero outro ou envio a collection por email.


## Exceções

1. ✅ Retorna erro **404** recurso não encontrado
2. ✅ Retorna erro **405** se o verbo http estiver incorreto
3. ✅ Retorna erro **422** se um parametro obrigatório não for passado
4. ✅ Retorna erro **500** erro interno no servidor

## License

[MIT license](https://opensource.org/licenses/MIT).