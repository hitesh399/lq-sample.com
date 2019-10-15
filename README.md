#Lq Sample

laravel new Project_name
lq-server copy
composer require singsys/laravel-quick
php artisan migrate
php artisan  notifications:table
php artisan  lq-make:migration
php artisan migrate
php artisan lq:install
composer require tucker-eric/eloquentfilter
php artisan db:seed
change auth driver and model in config/auth.php
guards.api.driver=passport
providers.users.model=App\Models\User::class
