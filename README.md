# online store by laravel

## docker nginx php7.2-fpm mysql redis

### RUN && Install docker containers 

`$ docker-compose up -d`

### run and install online store laravel  

open terminal and cd your path store

```
$ docker exec store-web bash -c 'composer install'
$ docker exec store-web bash -c 'php artisan key:generate'
$ docker exec store-web bash -c 'cp.env.example .env'
$ cp src php artisan key:generate
$ docker exec store-web bash -c '/root/.nvm/versions/node/v10.4.0/bin/npm install'
```