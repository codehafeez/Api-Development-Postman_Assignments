# api auth -> login and register
# https://www.youtube.com/watch?v=YuIbOzvS-Jk
# https://www.troposal.com/laravel-8-register-and-login-rest-api-using-passport/


php artisan make:controller Api/UserController
php artisan migrate


php artisan serve


Post => http://127.0.0.1:8000/api/register
Post => http://127.0.0.1:8000/api/login
Get => http://127.0.0.1:8000/api/user
Get => http://127.0.0.1:8000/api/user-detail



Accept => application/json
Authorization: 'Bearer (token)




var headers = {
  'Authorization': 'Bearer 5|AOEcrjySNPtLRwebELkH486RgXpIPCQPgv714Vqq'
};
var request = http.Request('GET', Uri.parse('http://127.0.0.1:8000/api/user'));

request.headers.addAll(headers);

http.StreamedResponse response = await request.send();

if (response.statusCode == 200) {
  print(await response.stream.bytesToString());
}
else {
  print(response.reasonPhrase);
}

