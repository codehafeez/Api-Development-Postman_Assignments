# -------------------------------------------------------------------
# Step1
# -------------------------------------------------------------------
laravel new hafeez-app
cd hafeez-app
php artisan serve



# -------------------------------------------------------------------
# Step2
# -------------------------------------------------------------------
-> Company Table
php artisan make:migration create_company_table
<!-- 
public function up(){
    Schema::create('company', function (Blueprint $table) {
        $table->increments('company_id');
        $table->string('company_name', 100);
        $table->string('company_address');
        $table->timestamps();
    });
}
-->


# -------------------------------------------------------------------
# Step3
# -------------------------------------------------------------------
php artisan migrate



# -------------------------------------------------------------------
# Step4
# -------------------------------------------------------------------
php artisan make:controller CompanyController
<!-- 
function getData(){
    return [
        "status" => true,
        "data" => 'test message hello world'
    ];
}
-->


# -------------------------------------------------------------------
# Step5
# -------------------------------------------------------------------
Go to (routes->api.php) and add controller in header ->
    CompanyController

and than call function ->
    Route::get('data', [CompanyController::class, 'getData']);



# -------------------------------------------------------------------
# Step6 
# -------------------------------------------------------------------
php artisan serve
http://127.0.0.1:8000/api/data



# -------------------------------------------------------------------
# Step7
# -------------------------------------------------------------------
https://magecomp.com/blog/laravel-8-create-application-programing-interface/

php artisan make:migration create_blogs_table
# So open your “routes/api.php” file and add the following route.
php artisan make:controller BlogController --resource
php artisan make:model Blog
php artisan migrate
php artisan serve

# (Get) => http://127.0.0.1:8000/api/data
# (Get) => http://127.0.0.1:8000/api/blogs
# (Get) => http://127.0.0.1:8000/api/blogs/1




# -------------------------------------------------------------------
# Important FIles
# -------------------------------------------------------------------
app -> Http -> Controllers -> BlogController.php
app -> Http -> Controllers -> CompanyController.php
app -> Models -> User.php
app -> Models -> Blog.php
routes -> api.php
database -> migrations -> 2023_02_05_231637_create_blogs_table.php
database -> migrations -> 2023_02_05_222648_create_company_table.php
