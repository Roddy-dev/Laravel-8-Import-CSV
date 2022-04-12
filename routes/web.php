<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');

//************************
Route::group(['middleware' => 'auth'], function () {
    //  import-csv-jan.test/admin/tasks
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        //this is name routes as admin.tasks.index
        'as' => 'admin',
    ], function () {
        Route::get(
            '/familie',
            [\App\Http\Controllers\Admin\FamilieController::class, 'index']
        )
            ->name('familie.index');

        Route::get(
            '/lebenslauf',
            [\App\Http\Controllers\Admin\LebenslaufController::class, 'index']
        )
            ->name('lebenslaufs.index');

        Route::get(
            '/verweise',
            [\App\Http\Controllers\Admin\VerweiseController::class, 'index']
        )
            ->name('verweises.index');
    });

    Route::group([
            //  roles-permissions-core.test/user/tasks
            //seperate controllers but same named route and access determined by middleware
        'prefix' => 'user',
        'as' => 'user.',
    ], function () {
        Route::get(
            'tasks',
            [\App\Http\Controllers\User\TaskController::class, 'index']
        )
            ->name('tasks.index');
    });

    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
});
//************************

// Route::get('/familie', [\App\Http    \Controllers\FamilieController::class, 'index'])->name('families.index');
// Route::get('/lebenslauf', [\App\Http\Controllers\LebenslaufController::class, 'index'])->name('lebenslaufs.index');
// Route::get('/verweise', [\App\Http\Controllers\VerweiseController::class, 'index'])->name('verweises.index');

Route::middleware('auth')->group(function () {
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/import_parse', [\App\Http\Controllers\ImportController::class, 'parseImport'])->name('import_parse');
Route::post('/import_process', [\App\Http\Controllers\ImportController::class, 'processImport'])->name('import_process');

require __DIR__.'/auth.php';
