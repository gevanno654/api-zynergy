<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MealReminder;
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
            'meal_delete_state' => 'required|integer|in:0,1',
            'toggle_value' => 'required|integer|in:0,1', // Tambahkan ini
        ]);

        $mealReminder = MealReminder::create([
            'user_id' => Auth::id(),
            'meal_name' => $validated['meal_name'],
            'meal_hour' => $validated['meal_hour'],
            'meal_minute' => $validated['meal_minute'],
            'meal_frequency' => $validated['meal_frequency'],
            'meal_delete_state' => $validated['meal_delete_state'],
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
            'meal_delete_state' => 'required|integer|in:0,1',
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
            'meal_delete_state' => $validated['meal_delete_state'],
            'toggle_value' => $validated['toggle_value'], // Tambahkan ini
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
}
