# Saitow Test - How to run

You may either run this project on your own environment or use Docker to run it.


## Requerements

 - PHP >= 5.4
 - Composer (https://getcomposer.org/)
 - A web server (eg. Apache / nginx)
 
 **OR**
 
 - Docker


	
 ## Libraries used
 
 
 - Slim Framework 3.0
 - Twig View 2.2
 - phpdotenv 2.4
 - Codeception
 
 
 
## Running with Docker

 - Build the docker image:
 
 $ `cd Docker`
 
 $ `docker build -t [tagName] .`
 
 - Running Docker

 $ `cd ../` (to navigate to project root)

 $ `docker run -v --name [Name] $(pwd)/src/:/var/www [tagName]` (map the **src** folder to **var/www**)
 
  - Composer
  
  you may either build the dependencies from the source machine:
  
 $ `composer install`
 
 or build it via the client machine:
 
 $ `docker exec -ti [Name] bash`
 
 $ `cd src` 
 
 $ `cp .env.example .env` (and edit it)
 
 $ `composer install` 


## Running via web server

 - Website configurations
 
 $ `cd src` 
 
 $ `cp .env.example .env` (and edit it)
 
 - We need to build the dependencies
 
 $ `composer install`
  
 - Then we need to configure the web server:

### Web Server configurations

#### Apache
	<VirtualHost *:80>

	    ServerAdmin webmaster@localhost
	    DocumentRoot /var/www/web

	    <Directory /var/www/web>
		Options Indexes FollowSymLinks
		AllowOverride All
		Require all granted
	    </Directory>

	</VirtualHost>

#### Nginx
	server {
		server_name [name]; 
		root /var/www/web;
		index index.php;

	    location / {    
		try_files $uri $uri/ /index.php?$query_string;
	    }               

	    location ~ \.php(/|$) {
		fastcgi_pass unix:/run/php-fpm/php-fpm.sock;
		fastcgi_split_path_info ^(.+\.php)(/.*)$;
		include fastcgi_params;
		fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
		fastcgi_param DOCUMENT_ROOT $realpath_root;
	    }

	}                   
