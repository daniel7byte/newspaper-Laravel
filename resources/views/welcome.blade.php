@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ config('app.name', 'Laravel') }}</div>

                    <div class="panel-body">
                        @inject('articles', 'App\Http\Controllers\SearchController')
                        <div class="row">
                            @foreach($articles->allArticles() as $article)
                                @if($article->active == true)
                                    @include('search.articleCard')
                                @else
                                    @if(Auth::check())
                                        @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                                            @include('search.articleCard')
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        {{ $articles->allArticles()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
