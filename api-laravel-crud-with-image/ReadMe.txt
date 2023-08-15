----------------------------------------------------------------------
CMD
----------------------------------------------------------------------
composer create-project --prefer-dist laravel/laravel crud_image_api
cd crud_image_api
php artisan serve
----------------------------------------------------------------------



----------------------------------------------------------------------
create databse mysql
----------------------------------------------------------------------
create databse (crud_image_api_db) and update (.env)

DB_DATABASE=crud_image_api_db
DB_USERNAME=root
DB_PASSWORD=
----------------------------------------------------------------------




----------------------------------------------------------------------
CMD
----------------------------------------------------------------------
php artisan make:migration create_resources_table --create=resources
----------------------------------------------------------------------


----------------------------------------------------------------------
database/migrations => 2023_05_31_182018_create_resources_table.php
----------------------------------------------------------------------
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateResourcesTable extends Migration
{
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resources');
    }
}




----------------------------------------------------------------------
CMD
----------------------------------------------------------------------
php artisan migrate
php artisan make:model Resource
----------------------------------------------------------------------




----------------------------------------------------------------------
routes/api.php
----------------------------------------------------------------------
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
Route::get('resources', [ResourceController::class, 'index']);
Route::post('resources', [ResourceController::class, 'store']);
Route::get('resources/{resource}', [ResourceController::class, 'show']);
Route::put('resources/{resource}', [ResourceController::class, 'update']);
Route::delete('resources/{resource}', [ResourceController::class, 'destroy']);
----------------------------------------------------------------------




----------------------------------------------------------------------
CMD
----------------------------------------------------------------------
php artisan make:controller ResourceController --api
----------------------------------------------------------------------




----------------------------------------------------------------------
app/Http/Controllers
----------------------------------------------------------------------
namespace App\Http\Controllers;
use App\Models\Resource;
use Illuminate\Http\Request;
class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        return response()->json($resources);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        $resource = Resource::create($validatedData);
        return response()->json($resource, 201);
    }

    public function show(Resource $resource)
    {
        return response()->json($resource);
    }

    public function update(Request $request, Resource $resource)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        $resource->update($validatedData);
        return response()->json($resource);
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return response()->json(null, 204);
    }
}
----------------------------------------------------------------------







----------------------------------------------------------------------
app/Models/Resource.php
----------------------------------------------------------------------
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Resource extends Model {
    use HasFactory;
    protected $fillable = ['name', 'age', 'image'];
}
----------------------------------------------------------------------






----------------------------------------------------------------------
CMD
----------------------------------------------------------------------
php artisan serve
----------------------------------------------------------------------
