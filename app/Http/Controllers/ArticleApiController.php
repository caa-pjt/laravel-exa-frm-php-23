<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }


    public function destroy(Article $article)
    {
        if ($article->quantity > 0) {
            return response()->json(['error' => 'Cannot delete an article with stock greater than 0'], 422);
        }

        $article->delete();
        return response()->json(['message' => 'Article deleted successfully'], 200);
    }
}
