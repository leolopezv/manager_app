<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;

//This trait is used to load relationships and is called for each relationship if it is included in the request
trait CanLoadRelationships
{
    public function loadRelationships(
        Model|QueryBuilder|EloquentBuilder|HasMany $for, //The model or query builder to load the relationships for
        ?array $relations = null//The relations to load and the default value is null
    ): Model|QueryBuilder|EloquentBuilder|HasMany
    {
        $relations = $relations ?? $this->relations ?? []; //If the relations are not passed, use the relations property of the class

        foreach ($relations as $relation) {
            $for->when(
                $this->shouldIncludeRelation($relation), //Check if the relation should be included
                fn ($q) => $for instanceof Model ? $for->load($relation) : $q->with($relation) //If the instance is a model, use the load method, otherwise use the with method
            );
        }
        return $for;
    }

    protected function shouldIncludeRelation(string $relation): bool
    {
        $include = request()->query('include');

        if (!$include) {
            return false;
        }

        $relations = array_map('trim', explode(',', $include));

        return in_array($relation, $relations);
    }
}
