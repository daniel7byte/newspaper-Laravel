<?php

namespace App\Repositories;

use App\Article;

class ArticleRepository
{
    public function byString($string)
    {
        return Article::where('title', 'LIKE', '%'.$string.'%')
            ->orWhere('description', 'LIKE', '%'.$string.'%')
            ->orWhere('grade_ref', 'LIKE', '%'.$string.'%')
            ->orWhere('category_ref', 'LIKE', '%'.$string.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(2);
    }
}
