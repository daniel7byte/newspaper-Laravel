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
                            <div class="media-left" style="padding-top: 7px;">
                                <i class="fa fa-newspaper-o fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="media-body" style="border-left: #2c3e50 solid 2px; padding-left: 7px;">
                                
                                <h3 class="media-heading">{{ $article->title }} 
                                    <small> | 
                                        <a href="{{ route('searchArticlesByInstitution', ['institution' => $article->institution_ref]) }}">{{ $article->institution_ref }}</a>, 

                                        <a href="{{ route('searchArticlesByGrade', ['grade' => $article->grade_ref]) }}">{{ $article->grade_ref }}</a>, 
                                        
                                        <a href="{{ route('searchArticlesByCategory', ['category' => $article->category_ref]) }}">{{ $article->category_ref }}</a>

                                        @if(Auth::check())
                                            @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                                                @if($article->active == true)
                                                    <span class="label label-xs label-success">Active</span>
                                                @else
                                                    <span class="label label-xs label-danger">Inactive</span>
                                                @endif
                                            @endif
                                        @endif

                                    </small>
                                </h3>

                                <h4 class="media-heading">created by <a href="{{ route('searchArticlesByUser', ['user' => $article->user->id]) }}">{{ $article->user->first_name }}</a> 
                                    <small> | 
                                        <a href="{{ route('searchArticlesByInstitution', ['institution' => $article->user->institution_ref]) }}">{{ $article->user->institution_ref }}</a>, 

                                        <a href="{{ route('searchArticlesByGrade', ['grade' => $article->user->grade]) }}">{{ $article->user->grade }}</a>

                                    </small>
                                </h4>
                            
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
                            <div class="col-md-12">
                                <div class="thumbnail">
                                    <a target="_blank" href="{{ ($article->url_video == '' ? '#!' : $article->url_video) }}">
                                        @if($article->image == null)
                                            <img src="/img/image404.png" alt="Image 404">
                                        @else
                                            <img src="/imagesArticles/{{ $article->image }}" alt="{{ $article->title }}">
                                        @endif
                                    </a>
                                    <div class="caption">
                                        <hr>
                                        <p>{!! $article->description !!}</p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection