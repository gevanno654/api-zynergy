<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MealReminderController;
use App\Http\Controllers\API\SleepReminderController;
use App\Http\Controllers\API\LightActivityReminderController;
use App\Http\Controllers\API\HealthCheckupReminderController;
use App\Http\Controllers\API\PersonalizedController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\SocialiteController;

Route::post('/auth/google/callback', [SocialiteController::class, 'handleProviderCallback']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOTP']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
    Route::post('/resend-otp', [AuthController::class, 'resendOTP']);
    Route::post('/user/update-name', [AuthController::class, 'updateName']);

    // Routes for reminders
    Route::resource('meal-reminders', MealReminderController::class)->except(['show']);
    Route::resource('sleep-reminders', SleepReminderController::class)->except(['show']);
    Route::resource('light-activity-reminders', LightActivityReminderController::class)->except(['show']);
    Route::resource('health-checkup-reminders', HealthCheckupReminderController::class)->except(['show']);

    // Routes for personalization
    Route::get('check-personalization-data', [PersonalizedController::class, 'checkPersonalizationData']);
    Route::post('personalize/interests', [PersonalizedController::class, 'storeInterests']);
    Route::post('personalize/favorites', [PersonalizedController::class, 'storeFavorites']);
    Route::post('personalize/diseases', [PersonalizedController::class, 'storeDiseases']);
    Route::post('personalize/allergies', [PersonalizedController::class, 'storeAllergies']);
    Route::post('/user/update-gender', [PersonalizedController::class, 'updateGender']);

    // New route for saving personalization data
    Route::post('save-personalization', [PersonalizedController::class, 'savePersonalization']);

    // Routes for reminders new

    // Meal Reminders
    Route::post('/meal-reminders', [MealReminderController::class, 'store']);
    Route::get('/meal-reminders', [MealReminderController::class, 'index']);
    Route::put('/meal-reminders/{id}/toggle', [MealReminderController::class, 'updateToggleValue']);
    Route::get('/meal-reminders/suggest', [MealReminderController::class, 'suggestMenus']);
    Route::get('/meal-reminders/suggest-avoids', [MealReminderController::class, 'suggestAvoids']);

    // Sleep Reminders
    Route::post('/sleep-reminders', [SleepReminderController::class, 'store']);
    Route::get('/sleep-reminders', [SleepReminderController::class, 'index']);
    Route::put('/sleep-reminders/{id}/toggle', [SleepReminderController::class, 'updateToggleValue']);

    // LightActivity Reminders
    Route::post('/light-activity-reminders', [LightActivityReminderController::class, 'store']);
    Route::get('/light-activity-reminders', [LightActivityReminderController::class, 'index']);
    Route::put('/light-activity-reminders/{id}/toggle', [LightActivityReminderController::class, 'updateToggleValue']);

    // Health Checkup Reminders
    Route::post('/health-checkup-reminders', [HealthCheckupReminderController::class, 'store']);
    Route::get('/health-checkup-reminders', [HealthCheckupReminderController::class, 'index']);
    Route::put('/health-checkup-reminders/{id}/toggle', [HealthCheckupReminderController::class, 'updateToggleValue']);

    // Articles
    Route::get('/articles/general', [ArticleController::class, 'getGeneralArticles']);
    Route::get('/articles/suggest', [ArticleController::class, 'suggestArticles']);
});

// Return authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
