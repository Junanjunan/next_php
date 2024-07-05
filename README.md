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

<hr>


This is a [Next.js](https://nextjs.org/) project bootstrapped with [`create-next-app`](https://github.com/vercel/next.js/tree/canary/packages/create-next-app).

## Getting Started

First, run the development server:

```bash
npm run dev
# or
yarn dev
# or
pnpm dev
# or
bun dev
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

You can start editing the page by modifying `app/page.js`. The page auto-updates as you edit the file.

This project uses [`next/font`](https://nextjs.org/docs/basic-features/font-optimization) to automatically optimize and load Inter, a custom Google Font.

## Learn More

To learn more about Next.js, take a look at the following resources:

- [Next.js Documentation](https://nextjs.org/docs) - learn about Next.js features and API.
- [Learn Next.js](https://nextjs.org/learn) - an interactive Next.js tutorial.

You can check out [the Next.js GitHub repository](https://github.com/vercel/next.js/) - your feedback and contributions are welcome!

## Deploy on Vercel

The easiest way to deploy your Next.js app is to use the [Vercel Platform](https://vercel.com/new?utm_medium=default-template&filter=next.js&utm_source=create-next-app&utm_campaign=create-next-app-readme) from the creators of Next.js.

Check out our [Next.js deployment documentation](https://nextjs.org/docs/deployment) for more details.
