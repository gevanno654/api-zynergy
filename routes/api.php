<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MealReminderController;
use App\Http\Controllers\API\SleepReminderController;
use App\Http\Controllers\API\LightActivityReminderController;
use App\Http\Controllers\API\HealthCheckupReminderController;
use App\Http\Controllers\API\PersonalizedController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verify-email', [AuthController::class, 'verifyEmail']);

    // Routes for reminders
    Route::resource('meal-reminders', MealReminderController::class);
    Route::resource('sleep-reminders', SleepReminderController::class);
    Route::resource('light-activity-reminders', LightActivityReminderController::class);
    Route::resource('health-checkup-reminders', HealthCheckupReminderController::class);

    // Routes for personalization
    Route::post('personalize/interests', [PersonalizedController::class, 'storeInterests']);
    Route::post('personalize/favorites', [PersonalizedController::class, 'storeFavorites']);
    Route::post('personalize/diseases', [PersonalizedController::class, 'storeDiseases']);
    Route::post('personalize/allergies', [PersonalizedController::class, 'storeAllergies']);

    // New route for saving personalization data
    Route::post('save-personalization', [PersonalizedController::class, 'savePersonalization']);

    // Routes for reminders new

    // Meal Reminders
    Route::post('/meal-reminders', [MealReminderController::class, 'store']);
    Route::get('/meal-reminders', [MealReminderController::class, 'index']);
    Route::put('/meal-reminders/{id}/toggle', [MealReminderController::class, 'updateToggleValue']);

    // Sleep Reminders
    Route::post('/sleep-reminders', [SleepReminderController::class, 'store']);
    Route::get('/sleep-reminders', [SleepReminderController::class, 'index']);
});

// Return authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
