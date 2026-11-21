@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <section class="page-section article-detail">
        <article class="content-card">
            @if ($article->published_at)
                <time class="article-date" datetime="{{ $article->published_at->toDateString() }}">
                    {{ $article->published_at->format('d.m.Y') }}
                </time>
            @endif
            <h1>{{ $article->title }}</h1>
            <p class="article-detail-content">{{ $article->content }}</p>

            <div class="article-actions">
                <a class="article-action-link" href="{{ route('articles.edit', $article) }}">Изменить</a>
                <form method="POST" action="{{ route('articles.destroy', $article) }}">
                    @csrf
                    @method('DELETE')
                    <button class="article-delete-button" type="submit">Удалить</button>
                </form>
                <a class="article-action-link" href="{{ route('articles.index') }}">К списку новостей</a>
            </div>
        </article>
    </section>
@endsection
