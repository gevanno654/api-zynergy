<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LightActivityReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LightActivityReminderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_name' => 'required|string',
            'activity_hour' => 'required|integer|min:0|max:23',
            'activity_minute' => 'required|integer|min:0|max:59',
            'activity_frequency' => 'required|integer|in:0,1',
            'toggle_value' => 'required|integer|in:0,1',
        ]);

        $lightActivityReminder = LightActivityReminder::create([
            'user_id' => Auth::id(),
            'activity_name' => $validated['activity_name'],
            'activity_hour' => $validated['activity_hour'],
            'activity_minute' => $validated['activity_minute'],
            'activity_frequency' => $validated['activity_frequency'],
            'toggle_value' => $validated['toggle_value'], // Tambahkan ini
            'activity_time' => Carbon::now(),
        ]);

        return response()->json($lightActivityReminder, 201);
    }
    
    public function index()
    {
        $lightActivityReminders = LightActivityReminder::where('user_id', Auth::id())->get();
        return response()->json($lightActivityReminders);
    }
    
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'activity_name' => 'required|string',
            'activity_hour' => 'required|integer|min:0|max:23',
            'activity_minute' => 'required|integer|min:0|max:59',
            'activity_frequency' => 'required|integer|in:0,1',
            'toggle_value' => 'required|integer|in:0,1',
        ]);

        $lightActivityReminder = LightActivityReminder::findOrFail($id);

        if ($lightActivityReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $lightActivityReminder->update([
            'activity_name' => $validated['activity_name'],
            'activity_hour' => $validated['activity_hour'],
            'activity_minute' => $validated['activity_minute'],
            'activity_frequency' => $validated['activity_frequency'],
            'toggle_value' => $validated['toggle_value'],
        ]);

        return response()->json($lightActivityReminder, 200);
    }
    
    public function updateToggleValue(Request $request, $id)
    {
        $validated = $request->validate([
            'toggle_value' => 'required|integer|in:0,1',
        ]);
    
        $lightActivityReminder = LightActivityReminder::findOrFail($id);
    
        if ($lightActivityReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $lightActivityReminder->update([
            'toggle_value' => $validated['toggle_value'],
        ]);
    
        return response()->json($lightActivityReminder, 200);
    }

    public function destroy($id)
    {
        $lightActivityReminder = LightActivityReminder::findOrFail($id);

        if ($lightActivityReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $lightActivityReminder->delete();

        return response()->json(['message' => 'Light activity reminder deleted successfully'], 200);
    }
}
