@extends('layouts.app')

@section('head')

    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 100%;
            margin: auto;
        }
    </style>

@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                      <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <div class="item active">
                        <img src="/img/slider/banner-portafolio-institucional.jpg">
                        <div class="carousel-caption">
                            <h3>Argemiro Escobar Cardona</h3>
                            <p>Instalaciones</p>
                        </div>
                      </div>

                      <div class="item">
                        <img src="/img/slider/Argemiro_1.jpg">
                        <div class="carousel-caption">
                            <h3>Argemiro Escobar Cardona</h3>
                            <p>Instalaciones</p>
                        </div>
                      </div>
                    
                      <div class="item">
                        <img src="/img/slider/Argemiro_2.jpg">
                        <div class="carousel-caption">
                            <h3>Argemiro Escobar Cardona</h3>
                            <p>Instalaciones</p>
                        </div>
                      </div>

                      <div class="item">
                        <img src="/img/slider/Argemiro_3.jpg">
                        <div class="carousel-caption">
                            <h3>Argemiro Escobar Cardona</h3>
                            <p>Instalaciones</p>
                        </div>
                      </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Last News</div>
                    
                    <div class="panel-body">
                        @inject('articles', 'App\Http\Controllers\SearchController')
                        @foreach($articles->allArticles() as $article)
                            @if($article->active == true)
                                @include('search.articleList')
                            @else
                                @if(Auth::check())
                                    @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                                        @include('search.articleList')
                                    @endif
                                @endif
                            @endif
                        @endforeach

                        <div class="text-center">
                            {{ $articles->allArticles()->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Search
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="searchForm" method="GET" action="{{ route('searchArticlesByString') }}">
                            <div class="input-group" id="searchDiv">
                                <input id="q" name="q" type="text" class="form-control" placeholder="Search" value="{{ old('string') }}">
                                    <div class="input-group-btn">
                                    <button class="btn btn-default" id="searchBtn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $( "#searchBtn" ).click(function() {
            event.preventDefault();
            if ( $( "#q" ).val() == "" ) {
                $( "#searchDiv" ).addClass( "has-warning" );
            }else{
                $( "#searchForm" ).submit();
            }
        });
    </script>
@endsection
