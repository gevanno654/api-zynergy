<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LightActivityReminder;
use Illuminate\Http\Request;

class LightActivityReminderController extends Controller
{
    public function index()
    {
        $lightActivityReminders = LightActivityReminder::all();
        return response()->json($lightActivityReminders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_type' => 'required|string',
            'frequency_in_hours' => 'required|integer',
        ]);

        $lightActivityReminder = LightActivityReminder::create([
            'user_id' => auth()->id(),
            'activity_type' => $validated['activity_type'],
            'frequency_in_hours' => $validated['frequency_in_hours'],
        ]);

        return response()->json($lightActivityReminder, 201);
    }

    public function show($id)
    {
        $lightActivityReminder = LightActivityReminder::findOrFail($id);
        return response()->json($lightActivityReminder);
    }

    public function update(Request $request, $id)
    {
        $lightActivityReminder = LightActivityReminder::findOrFail($id);

        $lightActivityReminder->update($request->only([
            'activity_type',
            'frequency_in_hours',
        ]));

        return response()->json($lightActivityReminder);
    }

    public function destroy($id)
    {
        LightActivityReminder::destroy($id);
        return response()->json(['message' => 'Reminder deleted']);
    }
}
