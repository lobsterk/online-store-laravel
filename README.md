# online store by laravel

## docker nginx php7.2-fpm mysql redis

### RUN && Install 

`$ docker-compose up -d`

install laravel

`$  docker exec store-web bash -c 'composer create-project --prefer-dist laravel/laravel .'`

`$  docker exec store-web bash -c 'npm run dev`