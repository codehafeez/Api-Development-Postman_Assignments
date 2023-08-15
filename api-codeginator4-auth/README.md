# CodeIgniter 4 

CMD => composer create-project codeigniter4/appstarter auth-api
CMD => cd auth-api

CMD => php spark make:model UserModel
CMD => php spark make:migration AddUser
CMD => php spark migrate

CMD => php spark make:controller Login
CMD => php spark make:controller Register
CMD => php spark make:controller User


----------------------------------------------------------------------------
CMD => composer require firebase/php-jwt
----------------------------------------------------------------------------
After installing the jwt package, add JWT_SECRET to the .env . file

Getnerate key => https://www.javainuse.com/jwtgenerator
than add to .env

JWT_SECRET = eyJhbGciOiJIUzI1NiJ9.eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTY4NjcyOTQzOSwiaWF0IjoxNjg2NzI5NDM5fQ.odc2d_8V_8rJ656GyCIYvsjvjQALoUnMAgEhHoIKyTU
----------------------------------------------------------------------------



CMD => php spark make:filter AuthFilter


// Routes.php (Add)
$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "User::index", ['filter' => 'authFilter']);
});


CMD => php spark serve


