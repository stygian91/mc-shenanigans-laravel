<?php

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

Route::middleware('auth')->group(function() {
    Route::get('/', function() {
        return view('home');
    });

    Route::get('/backup', function () {
        $zip_file = storage_path('app/public/world.zip');
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = env('MC_WORLD_PATH');
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file) {
            // We're skipping all subfolders
            if ($file->isDir()) {
                continue;
            }

            $filePath     = $file->getRealPath();

            // extracting filename with substr/strlen
            $relativePath = 'world/' . substr($filePath, strlen($path) + 1);

            $zip->addFile($filePath, $relativePath);
        }
        $zip->close();
        return response()->download($zip_file);
    })
        ->name('backup');

    Route::get('/locations', 'LocationController@index')
        ->name('locations.index');

    Route::get('/locations/search', 'LocationController@search')
        ->name('locations.search');

    Route::patch('/locations/{location}', 'LocationController@update')
        ->name('locations.update');

    Route::delete('/locations/{location}', 'LocationController@delete')
        ->name('locations.delete');

    Route::get('/locations/create', 'LocationController@create')
        ->name('locations.create');

    Route::post('/locations', 'LocationController@store')
        ->name('locations.store');
});

Auth::routes(['register' => false]);
