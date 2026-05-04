use App\Http\Controllers\Api\BlogController;

Route::post('/blogs', [BlogController::class, 'store']);