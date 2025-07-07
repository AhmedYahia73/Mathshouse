<?php

use App\Actions\SamplePermissionApi;
use App\Actions\SampleRoleApi;
use App\Actions\SampleUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\Login\AdminLoginController;

// MobileUser
Route::middleware(['auth:sanctum', 'auth.MobileAdmin'])->group(function(){

});