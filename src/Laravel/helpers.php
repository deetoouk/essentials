<?php

if (!function_exists('validate')) {
    function validate($input, $rules, array $messages = [], array $attributes = [])
    {
        if ($input instanceof \Illuminate\Http\Request) {
            $input = $input->all();
        }

        $validator = app('validator')->make((array)$input, $rules, $messages, $attributes);

        if ($validator->fails()) {
            throw new \DeeToo\Essentials\Exceptions\Errors($validator);
        }

        return array_only($input ?? [], array_keys($rules));
    }
}
