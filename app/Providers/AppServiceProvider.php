<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('success', function($message, $data){
            return response()->json([
                'status' => 200,
                'message' => $message,
                'data' => $data
            ], 200);
        });

        Response::macro('failed', function($message){
            return response()->json([
                'status' => 400,
                'message' => $message
            ], 400);
        });

        Response::macro('empty', function(){
            return response()->json([
                'status' => 400,
                'message' => 'No Record to Show'
            ], 400);
        });

        Response::macro('deleted', function(){
            return response()->json([
                'status' => 400,
                'message' => 'Data Deleted Successfully'
            ], 400);
        });
    }
}
