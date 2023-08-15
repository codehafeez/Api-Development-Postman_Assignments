# https://larainfo.com/blogs/laravel-9-rest-api-image-upload-with-validation-example

php artisan make:model Image -mc 
php artisan make:controller Api/ImageController  
php artisan make:request ImageStoreRequest 
php artisan migrate
php artisan storage:link


php artisan serve
http://127.0.0.1:8000/api/image



# http://127.0.0.1:8000/images/20230206154618.jpg

