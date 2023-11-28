<?php

namespace App\UseCases\Category;

use App\Exceptions\DatabaseUpdateException;
use App\Models\Category;

class UpdateAction
{
    public function __invoke(Category $category, string $category_id, string $category_name): Category
    {

        $original_category = $category->findOrFail($category_id);
        $original_category->name = $category_name;

        if (!$original_category->save()) {
            throw new DatabaseUpdateException('カテゴリ');
        }
        return $original_category;
    }
}
