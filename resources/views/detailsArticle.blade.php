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
                                <i class="fa fa-newspaper-o fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="media-body" style="border-left: #2c3e50 solid 2px; padding-left: 7px;">
                                <h4 class="media-heading">{{ $article->title }} <span class="label label-default">{{ $article->institution_ref }}</span> <span class="label label-default">{{ $article->grade_ref }}</span> <span class="label label-default">{{ $article->category_ref }}</span></h4>
                                Article by {{ $article->user->first_name }} <span class="label label-default">{{ $article->user->institution_ref }}</span> <span class="label label-default">{{ $article->user->grade }}</span>
                            </div>
                            @if(Auth::check())
                                @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                                    <div class="media-right">
                                        <a href="{{ route('articles.edit', ['articles' => $article->id]) }}" class="btn btn-success btn-block" role="button"><span class="fa fa-pencil" aria-hidden="true"></span></a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @if($article->active == true)
                                @include('search.articleDetailsBody')
                            @else
                                @if(Auth::check())
                                    @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                                        @include('search.articleDetailsBody')
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection