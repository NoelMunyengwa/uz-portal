<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('welcome');
});

Route::get('pdfs/{filename}', function ($filename) {
    $file = Storage::get('pdfs/' . $filename);
    return response()->make($file, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
})->name('download.pdf');
