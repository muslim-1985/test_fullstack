<?php

namespace App\Providers;

use App\Models\Book;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Book::creating(function($model) {
            if (isset($model->image)) {
                $imageName = $model->image->store('images');
                $model->image = $imageName;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
