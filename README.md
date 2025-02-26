# LinkDeck

This project generates a webpage displaying a collection of service links as interactive cards. Each card contains an image, title, description, and service name, all dynamically loaded from a configuration file.

![Demo image](https://cdn.mrweez.dev/public/Screenshot%20from%202025-02-26%2005-48-44.png)

## Features

- Dynamically generated cards with images, titles, and descriptions
- Supports PNG/JPG/SVG images
- Optional image inversion using the `invert` flag
- Separate configuration for site settings and metadata
- Fully responsive layout with simple styling using TailwindCSS

## Installation

1. Move to your webserver directory:
   ```sh
   cd /var/www
   ```
2. Clone this repository:
   ```sh
   git clone https://github.com/MrWeez/LinkDeck
   cd LinkDeck
   ```
3. Install dependencies (if you want to change CSS, otherwise you can skip this step):
   ```sh
   npm install
   ```
4. Copy configuration files from samples:
   ```sh
   cp ./config/sample.config.php ./config/config.php
   cp ./config/sample.cards.php ./config/cards.php
   ```
5. Configure your settings in `/config/config.php` and `/config/cards.php`
6. Set file permissions for your webserver:
   ```sh
   chown -R www-data:www-data /var/www/LinkDeck/
   chmod -R 755 /var/www/LinkDeck/
   ```
7. Setup your nginx:
   - Remove default configuration and open new file
   ```sh
   rm /etc/nginx/sites-enabled/default
   nano /etc/nginx/sites-available/linkdeck.conf
   ```
   - paste this configuration into your `linkdeck.conf`
   ```nginx
   server {
       # Replace YOUR.DOMAIN.HERE with your domain.
       listen 80;
       server_name YOUR.DOMAIN.HERE;

       root /var/www/linkdeck/public;
       index index.html index.htm index.php;
       charset utf-8;

       error_log  /var/log/nginx/linkdeck.app-error.log error;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
 
       location ~ \.php$ {
           fastcgi_split_path_info ^(.+\.php)(/.+)$;
           # CHANGE PHP-FPM VERSION
           fastcgi_pass unix:/run/php/php8.3-fpm.sock;
           fastcgi_index index.php;
           include fastcgi_params;
           fastcgi_param PHP_VALUE "upload_max_filesize = 100M \n post_max_size=100M";
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
           fastcgi_param HTTP_PROXY "";
           fastcgi_intercept_errors off;
           fastcgi_buffer_size 16k;
           fastcgi_buffers 4 16k;
           fastcgi_connect_timeout 300;
           fastcgi_send_timeout 300;
           fastcgi_read_timeout 300;
       }
 
       location ~ /\.ht {
           deny all;
       }
   }
   ```
   - Crete symlink of this file to your `sites-enabled` nginx directory:
   ```sh
   ln -s /etc/nginx/sites-available/linkdeck.conf /etc/nginx/sites-enabled/linkdeck.conf
   ```
   - Test nginx configuration and restart your nginx
   ```sh
   nginx -t && systemctl restart nginx
   ```
8. Acces your LinkDeck at `http://YOUR.DOMAIN.HERE`

## License

This project is licensed under the MIT License.
