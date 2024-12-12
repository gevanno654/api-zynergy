<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MealReminder;
use App\Models\Menu;
use App\Models\Avoid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MealReminderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meal_name' => 'required|string',
            'meal_hour' => 'required|integer|min:0|max:23',
            'meal_minute' => 'required|integer|min:0|max:59',
            'meal_frequency' => 'required|integer|in:0,1',
            'toggle_value' => 'required|integer|in:0,1', // Tambahkan ini
        ]);

        $mealReminder = MealReminder::create([
            'user_id' => Auth::id(),
            'meal_name' => $validated['meal_name'],
            'meal_hour' => $validated['meal_hour'],
            'meal_minute' => $validated['meal_minute'],
            'meal_frequency' => $validated['meal_frequency'],
            'toggle_value' => $validated['toggle_value'], // Tambahkan ini
            'meal_time' => Carbon::now(),
        ]);

        return response()->json($mealReminder, 201);
    }

    public function index()
    {
        $mealReminders = MealReminder::where('user_id', Auth::id())->get();
        return response()->json($mealReminders);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'meal_name' => 'required|string',
            'meal_hour' => 'required|integer|min:0|max:23',
            'meal_minute' => 'required|integer|min:0|max:59',
            'meal_frequency' => 'required|integer|in:0,1',
            'toggle_value' => 'required|integer|in:0,1', // Tambahkan ini
        ]);

        $mealReminder = MealReminder::findOrFail($id);

        if ($mealReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $mealReminder->update([
            'meal_name' => $validated['meal_name'],
            'meal_hour' => $validated['meal_hour'],
            'meal_minute' => $validated['meal_minute'],
            'meal_frequency' => $validated['meal_frequency'],
            'toggle_value' => $validated['toggle_value'], // Tambahkan ini
        ]);

        return response()->json($mealReminder, 200);
    }
    
    public function updateToggleValue(Request $request, $id)
    {
        $validated = $request->validate([
            'toggle_value' => 'required|integer|in:0,1',
        ]);
    
        $mealReminder = MealReminder::findOrFail($id);
    
        if ($mealReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $mealReminder->update([
            'toggle_value' => $validated['toggle_value'],
        ]);
    
        return response()->json($mealReminder, 200);
    }

    public function destroy($id)
    {
        $mealReminder = MealReminder::findOrFail($id);

        if ($mealReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $mealReminder->delete();

        return response()->json(['message' => 'Meal reminder deleted successfully'], 200);
    }
    
    public function suggestMenus()
    {
        $user = Auth::user();

        // Ambil semua favorite_id yang dipilih oleh user
        $favoriteIds = $user->favorites->pluck('id')->toArray();

        // Ambil semua allergy_id yang dipilih oleh user
        $allergyIds = $user->allergies->pluck('id')->toArray();

        // Cari menu yang sesuai dengan favorite_id dan tidak memiliki allergy_id yang sama dengan user
        $suggestedMenus = Menu::whereIn('favorite_id', $favoriteIds)
            ->whereNotIn('allergy_id', $allergyIds)
            ->get();

        return response()->json($suggestedMenus);
    }
    
    public function suggestAvoids()
    {
        $user = Auth::user();

        // Ambil semua disease_id yang dipilih oleh user
        $diseaseIds = $user->diseases->pluck('id')->toArray();

        // Cari avoids yang sesuai dengan disease_id
        $suggestedAvoids = Avoid::whereIn('disease_id', $diseaseIds)->get();

        return response()->json($suggestedAvoids);
    }
}