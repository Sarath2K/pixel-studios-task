# pixel-studio-interview-task
Make sure it is in development branch.
composer install
Import the dump which I attached in mail.
Make use of .env.example as .env
Updated env and DB name and password.(I used MySQL)
php artisan serve

If you're willing to connect to new DB please follow
update env file as required.
php artisan migrate:fresh --seed    
php artisan optimize:clear
composer dump-autoload
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan serve

Please use the below credentials.(Please use seperate browser windows)
Admin
email - admin@pixel-studios.com
password - password
