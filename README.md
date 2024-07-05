<h3>Nginx 설정</h3>

```nginx
# ex) /etc/nginx/sites-available/default

server {
        listen 80 default_server;
        listen [::]:80 default_server;

        root PROJECT_PATH;

        index index.php index.html index.htm index.nginx-debian.html;

        server_name localhost;

        location / {
                try_files $uri $uri/ =404;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php8.1-fpm.sock;
                add_header Access-Control-Allow-Origin "http://localhost:3000";
                add_header Access-Control-Allow-Credentials "true";
                add_header Access-Control-Allow-Methods "GET, POST, OPTIONS";
                add_header Access-Control-Allow-Headers "Content-Type, Authorization, X-Requested-With";
                if ($request_method = 'OPTIONS') {
                    add_header Access-Control-Allow-Origin 'http://localhost:3000';
                    add_header Access-Control-Allow-Methods 'GET, POST, OPTIONS';
                    add_header Access-Control-Allow-Credentials 'true';
                    add_header Access-Control-Allow-Headers 'Content-Type, Authorization, X-Requested-With';
                    return 204;
               }
        }

        location /profile/ {
                rewrite ^/profile/([a-zA-Z0-9]+)$ /profile.php?mb_id=$1 last;
        }

        location ~ /\.ht {
                deny all;
        }
}
```

<strong>Next.js: http://localhost:3000</strong>

<strong>PHP: http://localhost (80번 port)</strong>