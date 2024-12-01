<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HealthCheckupReminder;
use Illuminate\Http\Request;

class HealthCheckupReminderController extends Controller
{
    public function index()
    {
        $healthCheckupReminders = HealthCheckupReminder::all();
        return response()->json($healthCheckupReminders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'checkup_type' => 'required|string',
            'next_checkup_date' => 'required|date',
        ]);

        $healthCheckupReminder = HealthCheckupReminder::create([
            'user_id' => auth()->id(),
            'checkup_type' => $validated['checkup_type'],
            'next_checkup_date' => $validated['next_checkup_date'],
        ]);

        return response()->json($healthCheckupReminder, 201);
    }

    public function show($id)
    {
        $healthCheckupReminder = HealthCheckupReminder::findOrFail($id);
        return response()->json($healthCheckupReminder);
    }

    public function update(Request $request, $id)
    {
        $healthCheckupReminder = HealthCheckupReminder::findOrFail($id);

        $healthCheckupReminder->update($request->only([
            'checkup_type',
            'next_checkup_date',
        ]));

        return response()->json($healthCheckupReminder);
    }

    public function destroy($id)
    {
        HealthCheckupReminder::destroy($id);
        return response()->json(['message' => 'Reminder deleted']);
    }
}
