<?php

namespace App\UseCases\Category;

use App\Models\Category;
use \Illuminate\Database\Eloquent\Collection;

class IndexAction
{
    public function __invoke(Category $category): Collection
    {
        return $category->all()->sortByDesc('created_at');
    }
}
