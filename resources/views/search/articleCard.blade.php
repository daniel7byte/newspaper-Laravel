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
            <a href="{{ route('searchArticlesByInstitution', ['institution' => $article->institution_ref]) }}"><span class="label label-default">{{ $article->institution_ref }}</span></a>
            <a href="{{ route('searchArticlesByGrade', ['grade' => $article->grade_ref]) }}"><span class="label label-default">{{ $article->grade_ref }}</span></a>
            <a href="{{ route('searchArticlesByCategory', ['category' => $article->category_ref]) }}"><span class="label label-default">{{ $article->category_ref }}</span></a>
            @if(Auth::check())
                @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                    @if($article->active == true)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-danger">Inactive</span>
                    @endif
                    <hr>
                    <div class="btn-group btn-group-justified">
                        <a href="{{ route('articles.edit', ['articles' => $article->id]) }}" class="btn btn-success"><span class="fa fa-pencil" aria-hidden="true"></span> Edit</a>
                        
                        <a href="!#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</a>
                    </div>
                    @include('articles.delete')
                @endif
            @endif
            <div class="clearfix"></div>
        </div>
    </div>
</div>