<?php

namespace App\Filters;

class BookFilter extends QueryFilter
{
    public function categoryId($id = 1)
    {
        return $this->builder->whereHas('categories', function ($q) use ($id) {
            $q->where('id', $id);
        });
    }

    public function sortByTitle($sort = 'asc')
    {
        return $this->builder->orderBy('title', $sort);
    }

    public function search($sort = '')
    {
        return $this->builder->where('title', 'like', '%'.$sort.'%');
    }
}
