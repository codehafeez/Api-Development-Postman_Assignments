https://www.nicesnippets.com/blog/laravel-one-to-one-eloquent-relationship-example


# -------------------------------------------------------------------
# Step1
# -------------------------------------------------------------------
laravel new hafeez-app
cd hafeez-app
php artisan serve



# -------------------------------------------------------------------
# Step2
# -------------------------------------------------------------------
php artisan make:controller EmployeeController
php artisan make:controller SalaryController

php artisan make:model Employee -m
php artisan make:model Salary -m

php artisan migrate



php artisan serve
http://127.0.0.1:8000/api/addEmployee
http://127.0.0.1:8000/api/addSalary
http://127.0.0.1:8000/api/getData
http://127.0.0.1:8000/api/getDataJoin
http://127.0.0.1:8000/api/getDataHasOne



