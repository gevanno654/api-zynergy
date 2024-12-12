<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HealthCheckupReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HealthCheckupReminderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'checkup_name' => 'required|string',
            'checkup_year' => 'required|integer|min:2024|max:2050',
            'checkup_month' => 'required|integer|min:1|max:12',
            'checkup_date' => 'required|integer|min:1|max:31',
            'checkup_hour' => 'required|integer|min:0|max:23',
            'checkup_minute' => 'required|integer|min:0|max:59',
            'checkup_note' => 'required|string',
            'toggle_value' => 'required|integer|in:0,1',
        ]);

        $healthCheckupReminder = HealthCheckupReminder::create([
            'user_id' => Auth::id(),
            'checkup_name' => $validated['checkup_name'],
            'checkup_year' => $validated['checkup_year'],
            'checkup_month' => $validated['checkup_month'],
            'checkup_date' => $validated['checkup_date'],
            'checkup_hour' => $validated['checkup_hour'],
            'checkup_minute' => $validated['checkup_minute'],
            'checkup_note' => $validated['checkup_note'],
            'toggle_value' => $validated['toggle_value'],
            'checkup_time' => Carbon::now(),
        ]);

        return response()->json($healthCheckupReminder, 201);
    }
    
    public function index()
    {
        $healthCheckupReminders = HealthCheckupReminder::where('user_id', Auth::id())->get();
        return response()->json($healthCheckupReminders);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'checkup_name' => 'required|string',
            'checkup_year' => 'required|integer|min:2024|max:2050',
            'checkup_month' => 'required|integer|min:1|max:12',
            'checkup_date' => 'required|integer|min:1|max:31',
            'checkup_hour' => 'required|integer|min:0|max:23',
            'checkup_minute' => 'required|integer|min:0|max:59',
            'checkup_note' => 'required|string',
            'toggle_value' => 'required|integer|in:0,1',
        ]);
        
        $healthCheckupReminder = HealthCheckupReminder::findOrFail($id);
        
        if ($healthCheckupReminder->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $healthCheckupReminder->update([
            'checkup_name' => $validated['checkup_name'],
            'checkup_year' => $validated['checkup_year'],
            'checkup_month' => $validated['checkup_month'],
            'checkup_date' => $validated['checkup_date'],
            'checkup_hour' => $validated['checkup_hour'],
            'checkup_minute' => $validated['checkup_minute'],
            'checkup_note' => $validated['checkup_note'],
            'toggle_value' => $validated['toggle_value'],
        ]);

        return response()->json($healthCheckupReminder, 200);
    }

    public function destroy($id)
    {
        $healthCheckupReminder = HealthCheckupReminder::findOrFail($id);
        
        if ($healthCheckupReminder->user_id !== Auth::id()){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $healthCheckupReminder->delete();
        
        return response()->json(['message' => 'Checkup reminder deleted successfully'], 200);
    }
}
