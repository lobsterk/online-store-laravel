# online store by laravel

## docker nginx php7.2-fpm mysql redis

### RUN && Install 

`$ docker-compose up -d`

install laravel

`$  docker exec store-web bash -c 'cd /var/www ; composer create-project --prefer-dist laravel/laravel .'`

