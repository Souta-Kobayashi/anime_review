<?php

namespace App\UseCases\Category;

use App\Exceptions\DatabaseDestroyException;
use App\Models\Category;

class DestroyAction
{
    public function __invoke(Category $category, $id): Category
    {
        if (!$category->destroy($id)) {
            throw new DatabaseDestroyException('カテゴリ');
        }
        return $category;
    }
}
