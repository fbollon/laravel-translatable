<?php

namespace Fevrok\Translatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Translatable
{
    /**
     * @param string|Model|Collection $model
     *
     * @return bool
     */
    public function translatable($model)
    {
        if (! config('translatable.enabled')) {
            return false;
        }

        if (is_string($model)) {
            $model = app($model);
        }

        if ($model instanceof Collection) {
            $model = $model->first();
        }

        if (! is_subclass_of($model, Model::class)) {
            return false;
        }

        $traits = class_uses_recursive(get_class($model));

        return in_array(HasTranslations::class, $traits);
    }
}
