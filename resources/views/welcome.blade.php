@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @inject('articles', 'App\Http\Controllers\SearchController')
                        @foreach($articles->allArticles() as $article)
                            {{ $article->title }}
                        @endforeach

                        {{ $articles->allArticles()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
