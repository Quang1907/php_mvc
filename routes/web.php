<?php

use App\Controllers\ProductController;
use Core\Route;

Route::get("/product/{id}/{slug}", [ProductController::class, "index"])->where(["id" => "[0-9]+", "slug" => "[a-zA-Z]+"]);
Route::get("category", function () {
    echo "category";
});
