<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class AtLeastOne implements Rule
{
    protected $fields;

    public function __construct(...$fields)
    {
        $this->fields = $fields;
    }

    public function passes($attribute, $value)
    {
        $data = request()->all();
        $data = Arr::except($data, "_token");
        $filled = 0;

        foreach ($this->fields as $field) {
            if (!empty($data[$field])) {
                $filled++;
            }
        }

        return $filled > 0;
    }

    public function message()
    {
        return 'At least one of the fields must be filled.';
    }
}
