<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\Favorite;
use App\Models\Disease;
use App\Models\Allergy;
use App\Models\UserActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PersonalizedController extends Controller
{
    /**
     * Check user personalization data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkPersonalizationData(Request $request)
    {
        $user = Auth::user();

        $hasInterests = $user->interests()->exists();
        $hasFavorites = $user->favorites()->exists();
        $hasDiseases = $user->diseases()->exists();

        $hasPersonalizationData = $hasInterests && $hasFavorites && $hasDiseases;

        return response()->json([
            'success' => true,
            'has_data' => $hasPersonalizationData,
        ]);
    }
    
    public function updateGender(Request $request)
    {
        $request->validate([
            'gender' => 'required|in:male,female',
        ]);

        $user = auth()->user();
        $user->gender = $request->gender;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Gender updated successfully.',
            'data' => $user,
        ]);
    }
    
    /**
     * Store user interests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function storeInterests(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'interests' => 'required|array|min:1|max:3',
            'interests.*' => 'exists:interests,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $interests = $request->input('interests');

        foreach ($interests as $interestId) {
            UserInterest::create([
                'user_id' => $user->id,
                'interest_id' => $interestId,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Interests saved successfully',
        ]);
    }

    /**
     * Store user favorites.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeFavorites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'favorites' => 'required|array|min:1|max:3',
            'favorites.*' => 'exists:favorites,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $favorites = $request->input('favorites');

        foreach ($favorites as $favoriteId) {
            UserFavorite::create([
                'user_id' => $user->id,
                'favorite_id' => $favoriteId,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Favorites saved successfully',
        ]);
    }

    /**
     * Store user diseases.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeDiseases(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'diseases' => 'required|array|min:1|max:3',
            'diseases.*' => 'exists:diseases,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $diseases = $request->input('diseases');

        foreach ($diseases as $diseaseId) {
            UserDisease::create([
                'user_id' => $user->id,
                'disease_id' => $diseaseId,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Diseases saved successfully',
        ]);
    }

    /**
     * Store user allergies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAllergies(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'allergies' => 'required|array|min:1|max:3',
            'allergies.*' => 'exists:allergies,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $allergies = $request->input('allergies');

        foreach ($allergies as $allergyId) {
            UserAllergy::create([
                'user_id' => $user->id,
                'allergy_id' => $allergyId,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Allergies saved successfully',
        ]);
    }

    public function savePersonalization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'interests' => 'required|array|min:1|max:3',
            'interests.*' => 'exists:interests,id',
            'favorites' => 'required|array|min:1|max:3',
            'favorites.*' => 'exists:favorites,id',
            'diseases' => 'required|array|min:1|max:3',
            'diseases.*' => 'exists:diseases,id',
            'allergies' => 'required|array|min:1|max:3',
            'allergies.*' => 'exists:allergies,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $interests = $request->input('interests');
        $favorites = $request->input('favorites');
        $diseases = $request->input('diseases');
        $allergies = $request->input('allergies');

        // Simpan data ke tabel user_interests
        $user->interests()->sync($interests);

        // Simpan data ke tabel user_favorites
        $user->favorites()->sync($favorites);

        // Simpan data ke tabel user_diseases
        $user->diseases()->sync($diseases);

        // Simpan data ke tabel user_allergies
        $user->allergies()->sync($allergies);

        return response()->json([
            'success' => true,
            'message' => 'Personalization data saved successfully',
        ]);
    }
}
