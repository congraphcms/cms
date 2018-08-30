# Congraph CMS Project

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

