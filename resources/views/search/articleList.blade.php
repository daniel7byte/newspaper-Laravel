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
        <h3 class="media-heading">{{ $article->title }} 
            <small> | 
                <a href="{{ route('searchArticlesByInstitution', ['institution' => $article->institution_ref]) }}">{{ $article->institution_ref }}</a>, 

                <a href="{{ route('searchArticlesByGrade', ['grade' => $article->grade_ref]) }}">{{ $article->grade_ref }}</a>, 
                
                <a href="{{ route('searchArticlesByCategory', ['category' => $article->category_ref]) }}">{{ $article->category_ref }}</a>

            </small>
        </h3>
        <h4 class="media-heading">created by <a href="{{ route('searchArticlesByUser', ['user' => $article->user->id]) }}">{{ $article->user->first_name }}</a> 
            <small> | 
                <a href="{{ route('searchArticlesByInstitution', ['institution' => $article->user->institution_ref]) }}">{{ $article->user->institution_ref }}</a>, 

                <a href="{{ route('searchArticlesByGrade', ['grade' => $article->user->grade]) }}">{{ $article->user->grade }}</a>

            </small>
        </h4>
        <hr>

        <p>{!! \Illuminate\Support\Str::words(strip_tags($article->description), 50, '...') !!}</p>

        <hr>
        
        <a href="{{ route('detailsArticle', ['article' => $article]) }}" class="btn btn-success-invert"><i class="fa fa-share"></i> See More!</a>
        
        @if(Auth::check())
            @if($article->user->id === Auth::user()->id or Auth::user()->role == "ADMIN")
                <hr>
                Article Status: 
                @if($article->active == true)
                    <span class="label label-success">Active</span>
                @else
                    <span class="label label-danger">Inactive</span>
                @endif
                <hr>
                <div class="btn-group btn-group-justified">
                    <a href="{{ route('articles.edit', ['articles' => $article->id]) }}" class="btn btn-success"><span class="fa fa-pencil" aria-hidden="true"></span> Edit</a>
                    
                    <a href="!#" onclick="event.preventDefault(); sure();" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</a>
                </div>
                <script>
                    function sure() {
                        if(confirm('¿Quieres eliminar este Articulo?')){
                            document.getElementById('delete-form').submit();
                        }else{
                            return;
                        }
                    }
                </script>
                @include('articles.delete')
            @endif
        @endif

    </div>
    <div class="clearfix"></div>
</div>
<hr>
