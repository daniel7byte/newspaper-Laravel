@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.success')
                @include('alerts.warning')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-circle img-thumbnail UserAvatar" src="/imagesUsers/{{ $article->user->image }}" alt="{{ $article->user->first_name }}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Articles by</h4>
                                {{ $article->user->first_name }}
                            </div>
                            @if(Auth::check())
                                @if($article->user->id === Auth::user()->id)
                                    <div class="media-right">
                                        <a href="{{ route('articles.edit', ['articles' => $article->id]) }}" class="btn btn-success btn-block" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @if($article->active == true or Auth::check() && $article->user->id === Auth::user()->id)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <a href="{{ route('detailsArticle', ['article' => $article]) }}">
                                            @if($article->image == null)
                                                <img src="/img/image404.png" alt="Image 404">
                                            @else
                                                <img src="/imagesArticles/{{ $article->image }}" alt="{{ $article->title }}">
                                            @endif
                                        </a>
                                        <div class="caption">
                                            <h3>{{ $article->title }}</h3>
                                            <hr>
                                            <p>{!! $article->description !!}</p>
                                            <span class="label label-default">{{ $article->grade_ref }}</span>
                                            <span class="label label-default">{{ $article->category_ref }}</span>
                                            @if(Auth::check())
                                                @if($article->user->id === Auth::user()->id)
                                                    @if($article->active == true)
                                                        <span class="label label-success">Active</span>
                                                    @else
                                                        <span class="label label-danger">Inactive</span>
                                                    @endif
                                                @endif
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="text-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection