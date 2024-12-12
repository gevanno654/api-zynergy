<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function suggestArticles()
    {
        $user = Auth::user();

        // Ambil semua interest_id yang dipilih oleh user
        $interestIds = $user->interests->pluck('id')->toArray();

        // Cari artikel yang sesuai dengan interest_id atau artikel umum
        $suggestedArticles = Article::whereIn('interest_id', $interestIds)
            // ->orWhere('is_general', true)
            ->get();

        return response()->json($suggestedArticles);
    }
    
    public function getGeneralArticles()
    {
        $generalArticles = Article::where('is_general', true)->get();
        return response()->json($generalArticles);
    }
}
