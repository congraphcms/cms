# Congraph CMS Project
## Installation
Congraph CMS Installation has 2 parts: Laravel API installation and NodeJS Admin installation
Your folder structure should be:
```
/projects-folder
---- /new-project
--------- /new-project-api
--------- /new-project-admin
--------- /new-project-app
```
api folder for laravel app, admin folder for admin app and app folder for frontend Nuxt application

### Laravel API
With Composer install version dev-master:
```
composer create-project congraph/cms [folder-name] [version]
composer create-project congraph/cms new-project-api dev-master
```
This should pull all the files to your computer and install all php dependencies

Next thing you should do is setup your database, recomended naming for DB is to have 'cg_' prefix, and have utf8_general_ci collation

Once you have DB setup, you should edit .env file.
Go to root of your `new-project-api` folder and find `.env` file, if for some reason that file doesn't exist you can duplicate the `.env.example` file and name it .env
Here you can find all the settings for your environment
Settings that you need to set before going further are:
1. `DB_DATABASE` - name for your mysql database
2. `DB_USERNAME` - username for accessing mysql DB
3. `DB_PASSWORD` - password for that user (leave blank if you don't use password)
4. `USING_ELASTIC` - flag for use of elasticsearch DB, you will know if you are using it, otherwise set this to `false`. If you are using elasticsearch in your project you should uncomment EntityElasticServiceProvider in your app config `/config/app.php`. 

Now we need to run few artisan commands in CMD/Terminal
1. First we want to generate a random App Key for the new application
```
php artisan key:generate
```
2. We want to generate optimized loader for laravel
```
php artisan optimize
```
1. Next we want to run Congraph init script that will a) migrate DB tables. b) run seeders for initaial DB data c) create 2 new client apps for Congraph.
```
php artisan congraph:init
```
This command should print out settings for 2 apps (Administration App, Frontend App). You should copy these settings to some file or note. Later you can find them in your database.

#### Setting WAMP Server for Laravel API
1. choose a url for your API, recomended url should start with 'api.', for example `http://api.new-project.com` | `http://api.new-project.test` | `http://api.new-project.localhost` for local development
2. change hosts file: you can find it in `C:\Windows\System32\drivers\etc`
3. add new line in hosts file and write your new URL
```
127.0.0.1 api.new-project.localhost
```
4. change apache config for virtual hosts, you can find it in `C:\wamp64\bin\apache\apache2.4.33\conf\extra` config file `httpd-vhosts.conf`
5. add new virtual host
```
<VirtualHost *:80>
 ServerName api.new-project.localhost
 DocumentRoot "${INSTALL_DIR}/www/new-project/new-project-api/public"
 <Directory "${INSTALL_DIR}/www/new-project/new-project-api/public">
   Options +Indexes +Includes +FollowSymLinks +MultiViews
   AllowOverride All
   Require local
 </Directory>
</VirtualHost>
```
6. restart WAMP Server
7. try going to that URL in your browser - you should get white page with "Laravel 5" heading

### NodeJS Administration App
We will install the admin app by cloning the repository from github
```
git clone git@github.com:congraphcms/admin.git [directory]
git clone git@github.com:congraphcms/admin.git new-project-admin
```
after cloning the repo we want to move to the admin project folder and run npm installer
```
npm install
```
This should install all dependencies to our local environment

We need to setup our environment like with laravel project. First we need to duplicate the `.env.example` file and name it `.env`.
```
cp .env.example .env
```
And now we can change the `.env` file. Settings we need to set:
1. `APP_URL` usually 'localhost:8080' but you can set it to any port or custom URL. Note: If you are using custom URL that is not localhost you need to have ngnix or appache set to proxy requests to your app. For local development it's recommended to stick to the localhost scheme.
2. `APP_PORT` should be same as port in `APP_URL`
3. `APP_HOST` should be same as host in `APP_URL`
4. `CG_URL` URL where we can find Congraph API (include the `/` at the end of URL)
5. `CG_CLIENT_ID` paste the value from Laravel APP for Administration App ID
6. `CG_CLIENT_SECRET` paste the value from Laravel APP for Administration App SECRET
7. `NODE_ENV` set to 'local' for local dev environment or 'production' for use on the production server

With these parameters set, we can run the Administration App
```
npm run start
```

Aplication should be available at your specified location default http://localhost:8080
You should successfully login with credentials:
email: john.doe@example.com
password: secret

#### Troubleshoot
1. If you get CORS policy error when trying to log in (check DevTools console for that).
Go to your Laravel API project folder and then go to `/vendor/congraph/api/Http/routes.php` file
Uncomment the 5. line `header('Access-Control-Allow-Origin: *');`
Try to log in again.


## Deployment
### Info
3 Apps need deployment

 - API app (api)
 - Admin app (admin|cms)
 - Frontend app

## API Deployment
Requirements:
 - MySQL | MariaDB installed
 - Elasticsearch installed
 - PHP ^7.0 installed

Steps:
 - Copy files
 - Configuration
 - DB Seed

### Copy files
1. Copy all files compressed in a .zip file including "vendor" folder if composer is not available on the server.
2. Unzip files on the server over ssh.
3. Set permissions for files.
Hokosoft servers:
```
chown -R {$domain}:www /usr/local/www/data/{$domain}
chmod -R 750 /usr/local/www/data/{$domain}
```

### Configuration
1. Change .env file (mysql settings, es settings, index name, app key etc.)
2. If using apache server add this to .htaccess file in /public folder
```
    RewriteCond %{HTTP:Authorization} ^(.*)
    RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
```
3. Change domain in app.php file in /config folder

### DB Seed
1. Upload empty Congraph db to server and import it
2. Check DefaultWorkflowSeeder.php and OAuthSeeder.php in /database/seeds folder, if data is ok for this setup run the seeders
3. Run the seeders with
```
php artisan db:seed --class=DefaultWorkflowSeeder
php artisan db:seed --class=OAuthSeeder
```

## Admin App Depoloyment
Requirements:
 - node and npm installed on server
 - preferably pm2 install on server

