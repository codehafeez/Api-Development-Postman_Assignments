composer install


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
php artisan make:model Company



# -------------------------------------------------------------------
# Step5
# -------------------------------------------------------------------
Go to (routes->api.php) add (CompanyController) in header and than call function



# -------------------------------------------------------------------
# Step6 
# -------------------------------------------------------------------
php artisan serve
http://127.0.0.1:8000/api/getDataAll
http://127.0.0.1:8000/api/getData/1
http://127.0.0.1:8000/api/deleteData/1








# -------------------------------------------------------------------
# Important FIles
# -------------------------------------------------------------------
routes -> api.php
app -> Http -> Controllers -> CompanyController.php
app -> Models -> Company.php
database -> migrations -> 2023_02_05_222648_create_company_table.php
