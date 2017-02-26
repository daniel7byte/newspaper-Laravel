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
                                    <img class="media-object img-circle img-thumbnail UserAvatar" src="/imagesUsers/{{ $user->image }}" alt="{{ $user->first_name }}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Articles by</h4>
                                {{ $user->first_name }}
                            </div>
                            @if(Auth::check())
                                @if($user->id === Auth::user()->id)
                                    <div class="media-right">
                                        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-block"><span class="fa fa-plus" aria-hidden="true"></span></a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach ($articles as $article)
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
                        <div class="text-center">
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection