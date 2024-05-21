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
Local artisan server.
- [localhost:80](http://localhost:80)
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders, if any.
- Run `php artisan serve`

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
