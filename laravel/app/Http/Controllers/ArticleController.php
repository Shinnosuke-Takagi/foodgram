<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct()
    {
      $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
      $articles = Article::all()->sortByDesc('create_at')->load(['user', 'likes', 'tags']);

      return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
      return view('articles.create');
    }

    public function store(ArticleRequest $request, Article $article)
    {

      $article->fill($request->all());
      $article->filename = $request->filename->hashName();
      $article->user_id = $request->user()->id;

      Storage::cloud()
        ->putFileAs('', $request->filename, $article->filename, 'public');

      $article->save();

      $request->tags->each(function ($tagName) use ($article) {
          $tag = Tag::firstOrCreate(['name' => $tagName]);
          $article->tags()->attach($tag);
      });

      return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
      $tagNames = $article->tags->map(function($tag) {
        return ['text' => $tag->name];
      });

      return view('articles.edit', [
        'article' => $article,
        'tagNames' => $tagNames,
      ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
      $article->fill($request->all())->save();

      $article->tags()->detach();
      $request->tags->each(function($tagName) use ($article) {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $article->tags()->attach($tag);
      });

      return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
      Storage::cloud()->delete($article->filename);
      $article->delete();
      return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
      return view('articles.show', ['article' => $article]);
    }

    public function like(Request $request, Article $article)
    {
      $article->likes()->detach($request->user()->id);
      $article->likes()->attach($request->user()->id);

      return [
        'id' => $article->id,
        'countLikes' => $article->count_likes,
      ];
    }

    public function unlike(Request $request, Article $article)
    {
      $article->likes()->detach($request->user()->id);

      return [
        'id' => $article->id,
        'countLikes' => $article->count_likes,
      ];
    }
}
