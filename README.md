# Follow the following to steup a start kit with Laravel and vueJs

###### Setup Laravel
- npm install lq-server-cli --global
- mkdir project_name
- cd project_name 
- laravel new server
- cd server
- composer require laravel/passport if not working try composer require laravel/passport "7.*
- composer require singsys/laravel-quick dev-master
- lq-server-cli (use —overwrite to replace the files)
- cp .env .env.production (update credentials like database, session and more) 
- composer require spatie/flysystem-dropbox
- composer require tucker-eric/eloquentfilter
- composer require nao-pon/flysystem-google-drive
- php artisan vendor:publish --tag=passport-migrations
- php artisan lq-make:migration
- php artisan migrate
- php artisan lq:install
- php artisan db:seed

**give read write permission to storage folder**

**_Now Setup is completed, use php artisan lq:client to get client id_**

###### Setup VueJs
- cd ../
- git clone https://github.com/hitesh399/lq-vuetify-sample.git client && rm -rf client/.git
- cd client 
- yarn install (if yarn is not install use npm I —global yarn to install yarn cli.)
- echo "local" > .env
- cp .env.production .env.local (open .env.local change api base url.)
- cp .env.admin.production .env.admin.local (open .env.admin.local change client id, domain, domain prefix )
- Make key VUE_APP_CHECK_PERMISSION value as false becuase initially route is not registered so menus will not display if the  value is true. 
- yarn serve-admin 
- To Login check user table in database pick user email and password is 12345678 for all users.
