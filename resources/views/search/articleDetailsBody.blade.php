<div class="col-md-12">
    <div class="thumbnail">
        <a href="{{ route('detailsArticle', ['article' => $article]) }}">
            @if($article->image == null)
                <img src="/img/image404.png" alt="Image 404">
            @else
                <img src="/imagesArticles/{{ $article->image }}" alt="{{ $article->title }}">
            @endif
        </a>
        <div class="caption">
            <hr>
            <p>{!! $article->description !!}</p>
            @if(Auth::check())
                @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
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