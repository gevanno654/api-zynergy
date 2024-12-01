<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SleepReminder;
use Illuminate\Http\Request;

class SleepReminderController extends Controller
{
    public function index()
    {
        $sleepReminders = SleepReminder::all();
        return response()->json($sleepReminders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bedtime' => 'required|date_format:H:i',
            'wake_up_time' => 'required|date_format:H:i',
        ]);

        $sleepReminder = SleepReminder::create([
            'user_id' => auth()->id(),
            'bedtime' => $validated['bedtime'],
            'wake_up_time' => $validated['wake_up_time'],
        ]);

        return response()->json($sleepReminder, 201);
    }

    public function show($id)
    {
        $sleepReminder = SleepReminder::findOrFail($id);
        return response()->json($sleepReminder);
    }

    public function update(Request $request, $id)
    {
        $sleepReminder = SleepReminder::findOrFail($id);

        $sleepReminder->update($request->only([
            'bedtime',
            'wake_up_time',
        ]));

        return response()->json($sleepReminder);
    }

    public function destroy($id)
    {
        SleepReminder::destroy($id);
        return response()->json(['message' => 'Reminder deleted']);
    }
}
