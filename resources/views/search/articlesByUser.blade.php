@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle img-thumbnail UserAvatar" src="/imagesUsers/{{ $user->image }}" alt="{{ $user->first_name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Articles by</h4>
                            {{ $user->first_name }}
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        @foreach ($articles as $article)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="/imagesArticles/{{ $article->image }}" alt="{{ $article->title }}">
                                    <div class="caption">
                                        <h3>{{ $article->title }}</h3>
                                        <p>{{ $article->description }}</p>
                                        <hr>
                                        <span class="label label-default">{{ $article->grade_ref }}</span>
                                        <span class="label label-default">{{ $article->category_ref }}</span>
                                        @if(Auth::check() && $article->user->id === Auth::user()->id)
                                            <hr>
                                            <p>
                                                <a href="{{ route('articles.edit', ['articles' => $article->id]) }}" class="btn btn-success btn-block" role="button">Editar <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                            </p>
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
