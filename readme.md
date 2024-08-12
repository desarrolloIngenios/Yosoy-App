# YOSOY APP
Yo soy project repository.

## ENVIRONMENTS:
### Production
- [app.yo-soy.co](https://app.yo-soy.co)
- Kubernetes deployment in aws cluster.
- Image built with **dockerfile** file and pushed to AWS ECR.
- Kubernetes manifest are included in **.kubernetes** directory.
- Workflow for ci cd is included in **.github/workflows/production** file.
- For deploy, create a new pull request to main branch and check **Production** workflow in github actions tab.
### Development
- [app.yosoydev.tk](https://app.yosoydev.tk/)
- Docker compose deployment in EC2 Instance.
- Image built inside docker compose with **dockerfile** file.
- Workflow for ci cd is included in **.github/workflows/development** file.
- For deploy, push your changes to dev branch and check Develpment workflow in github actions tab.
### Local
### crear archivo .env

APP_NAME=Laravel
APP_ENV=local
APP_KEY= generar Api key
APP_DEBUG=true
APP_URL=http://localhost

credenciales base de datos local
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yo_soy
DB_USERNAME=root
DB_PASSWORD=

### banderas
API_FLAG=false
WEB_FLAG=false

### logs
LOG_CHANNEL=stack
LOG_LEVEL=debug

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

### Servicio de Mensajería
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=noreply.authenticfarma@gmail.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply.authenticfarma@gmail.com
MAIL_FROM_NAME="Yo Soy"

### AWS
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
 AWS_DEFAULT_REGION=us-east-2
AWS_BUCKET=yosoygaleria
 AWS_USE_PATH_STYLE_ENDPOINT=false

### Recaptcha google

RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=

Local artisan server.
- [localhost:80](http://localhost:80)

- Run `composer update`
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders, if any.
- Run `php artisan passport:install` para crear archivos oauth private.key y public.key.

- Run `composer dump-autoload` 
- Run `php artisan optimize` optimiza el repositorio antes de lanzarlo
- Run `php artisan serve`

Para limpieza de caché
- Run `php artisan config:cache` 
- Run `php artisan cache:clear`### Local
### crear archivo .env

APP_NAME=Laravel
APP_ENV=local
APP_KEY= generar Api key
APP_DEBUG=true
APP_URL=http://localhost

credenciales base de datos local
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yo_soy
DB_USERNAME=root
DB_PASSWORD=

### banderas
API_FLAG=false
WEB_FLAG=false

### logs
LOG_CHANNEL=stack
LOG_LEVEL=debug

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

### Servicio de Mensajería
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=noreply.authenticfarma@gmail.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply.authenticfarma@gmail.com
MAIL_FROM_NAME="Yo Soy"

### AWS
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
 AWS_DEFAULT_REGION=us-east-2
AWS_BUCKET=yosoygaleria
 AWS_USE_PATH_STYLE_ENDPOINT=false

### Recaptcha google

RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=

Local artisan server.
- [localhost:80](http://localhost:80)

- Run `composer update`
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders, if any.
- Run `php artisan passport:install` para crear archivos oauth private.key y public.key.

- Run `composer dump-autoload` 
- Run `php artisan optimize` optimiza el repositorio antes de lanzarlo
- Run `php artisan serve`

Para limpieza de caché
- Run `php artisan config:cache` 
- Run `php artisan cache:clear`

## SECRETS
### Production
- **AWS_ACCESS_KEY_ID**
- **AWS_SECRET_ACCESS_KEY**
- **KUBE_CONFIG_DATA**
### Developement
- **EC2_HOST**
- **EC2_KEY**
## DNS RECORDS
- **app.yo-soy.co** pointing to ELB in Kubernetes cluster.
- **app.yosoydev.tk** pointing to EC2 Instance public ip.


## vista de test
ejemplo de despliegue desde local a maquinas en aws
