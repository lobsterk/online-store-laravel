# online store by laravel

## docker nginx php7.2-fpm mysql redis

### RUN && Install docker containers 

#### Run docker compose

`docker-compose up -d`

#### Go in container

`docker-compose exec web bash`

#### Run every command
```
# install php vendor
composer install
# install js vendor 
npm install
npm run prod

#set chmod 
chmod -R 777 /var/www/storage/logs/
chmod -R 777 /var/www/storage/framework/views/
chmod -R 777 /var/www/storage/framework/sessions/

# install db migrate and seed
php artisan migrate:refresh --seed
# or 
php artisan migrate 
php artisan db:seed
```


