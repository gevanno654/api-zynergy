<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SleepReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SleepReminderController extends Controller
{
    public function index()
    {
        $sleepReminders = SleepReminder::where('user_id', auth()->id())->get();
        return response()->json($sleepReminders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sleep_name' => 'required|string',
            'sleep_hour' => 'required|integer|min:0|max:23',
            'sleep_minute' => 'required|integer|min:0|max:59',
            'wake_hour' => 'required|integer|min:0|max:23',
            'wake_minute' => 'required|integer|min:0|max:59',
            'sleep_frequency' => 'required|integer|in:0,1',
            'toggle_value' => 'required|integer|in:0,1',
        ]);

        $sleepReminder = SleepReminder::create([
            'user_id' => auth()->id(),
            'sleep_name' => $validated['sleep_name'],
            'sleep_hour' => $validated['sleep_hour'],
            'sleep_minute' => $validated['sleep_minute'],
            'wake_hour' => $validated['wake_hour'],
            'wake_minute' => $validated['wake_minute'],
            'sleep_frequency' => $validated['sleep_frequency'],
            'toggle_value' => $validated['toggle_value'],
            'sleep_time' => Carbon::now(),
        ]);

        return response()->json($sleepReminder, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sleep_name' => 'required|string',
            'sleep_hour' => 'required|integer|min:0|max:23',
            'sleep_minute' => 'required|integer|min:0|max:59',
            'wake_hour' => 'required|integer|min:0|max:23',
            'wake_minute' => 'required|integer|min:0|max:59',
            'sleep_frequency' => 'required|integer|in:0,1',
            'toggle_value' => 'required|integer|in:0,1',
        ]);

        $sleepReminder = SleepReminder::findOrFail($id);

        if ($sleepReminder->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $sleepReminder->update([
            'sleep_name' => $validated['sleep_name'],
            'sleep_hour' => $validated['sleep_hour'],
            'sleep_minute' => $validated['sleep_minute'],
            'wake_hour' => $validated['wake_hour'],
            'wake_minute' => $validated['wake_minute'],
            'sleep_frequency' => $validated['sleep_frequency'],
            'toggle_value' => $validated['toggle_value'],
        ]);

        return response()->json($sleepReminder, 200);
    }
    
    public function updateToggleValue(Request $request, $id)
    {
        $validated = $request->validate([
            'toggle_value' => 'required|integer|in:0,1',
        ]);

        $sleepReminder = SleepReminder::findOrFail($id);

        if ($sleepReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $sleepReminder->update([
            'toggle_value' => $validated['toggle_value'],
        ]);

        return response()->json($sleepReminder, 200);
    }

    public function destroy($id)
    {
        $sleepReminder = SleepReminder::where('user_id', auth()->id())->findOrFail($id);
        $sleepReminder->delete();
        return response()->json(['message' => 'Reminder deleted']);
    }
}