### Para exportar MySQL

```shell
docker-compose exec -T mysql_super_gestao mysqldump --no-tablespaces -u root -p"senha" supergestao > supergestao.sql
```


### Para importar um arquivo .sql (MySQL)

Ps: A `senha` está no `./docker-compose.yaml`, mude tudo que quiser, mas precisará editar o `/src/wp-config.php`

```shell
docker-compose exec -T mysql_super_gestao mysql -u root -p"senha" supergestao < supergestao.sql
```
```shell
docker exec -it php_8_1_super_gestao php artisan key:generate
```


http://local.supergestao.com.br:7090/