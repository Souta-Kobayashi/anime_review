<?php

namespace App\UseCases\Category;

use App\Exceptions\DatabaseStoreException;
use App\Models\Category;

class StoreAction
{
    public function __invoke(Category $category): Category
    {
        if (!$category->save()) {
            throw new DatabaseStoreException('カテゴリ');
        }
        return $category;
    }
}
