<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $count = Article::sum('quantity');

        return view('articles.index', ['articles' => Article::all(), "count" => $count]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $article = new Article();
        return view('articles.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        Article::create($request->except('_token', '_method'));
        return redirect()->route('articles.index')->with('success', 'Article created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view("articles.edit", ["article" => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->validated());
        return redirect()->route("articles.index")->with("success", "Article updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {

        if ($article->quantity > 0) {
            return redirect()->route('articles.index')->with('error', 'Cannot delete an article with stock greater than 0');
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }


    public function incrementStock(Article $article)
    {
        $art = Article::findOrFail($article->id);
        $art->quantity++;
        $art->save();
        return redirect()->route('articles.index')->with('success', 'Stock increased for the article');
    }
}
