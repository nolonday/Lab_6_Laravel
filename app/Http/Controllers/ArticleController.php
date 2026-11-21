<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('articles.index', [
            'articles' => Article::query()
                ->latest('published_at')
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('articles.create', [
            'article' => new Article,
        ]);
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        Article::create($request->validated());

        return redirect()
            ->route('articles.index')
            ->with('status', 'Новость успешно создана.');
    }

    public function show(Article $article): View
    {
        return view('articles.show', [
            'article' => $article,
        ]);
    }

    public function edit(Article $article): View
    {
        return view('articles.edit', [
            'article' => $article,
        ]);
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());

        return redirect()
            ->route('articles.index')
            ->with('status', 'Новость успешно обновлена.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('status', 'Новость успешно удалена.');
    }
}
