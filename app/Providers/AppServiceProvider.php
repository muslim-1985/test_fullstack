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
                $imageName = $model->image->store('images', 'public');
                $model->image = $imageName;
            }
        });
        Book::deleting(function($model) {
            unlink(public_path("storage/$model->image"));
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
