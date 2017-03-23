<div class="media">
    <div class="media-left media-middle">
        <a href="{{ route('detailsArticle', ['article' => $article]) }}">
            @if($article->image == null)
                <img class="media-object" style="max-width: 150px" src="/img/image404.png" alt="Image 404">
            @else
                <img class="media-object" style="max-width: 150px" src="/imagesArticles/{{ $article->image }}" alt="{{ $article->title }}">
            @endif
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">{{ $article->title }}</h4>
        {!! $article->description !!}
        <hr>
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
    </div>
    <div class="clearfix"></div>
</div>
<hr>
