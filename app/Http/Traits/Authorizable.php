<?php

namespace App\Http\Traits;

trait Authorizable
{
    /**
     * @param string $ability
     * @param $model
     * @return bool
     */
    public function authorizeWithoutException(string $ability, $model): bool
    {
        try {
            \Gate::authorize($ability, $model); //app(Gate::class)->forUser($this)->check($ability, $model);

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}