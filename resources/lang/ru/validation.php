<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute должен быть принят.',
    'active_url' => ':attribute не является допустимым URL.',
    'after' => ':attribute должен быть датой после :date.',
    'alpha' => ':attribute может содержать только буквы.',
    'alpha_dash' => ':attribute может содержать только буквы, цифры и тире.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой до :date.',
    'between' => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file' => ':attribute должно быть между :min и :max килобайт.',
        'string' => ':attribute должно быть между :min и :max символов.',
        'array' => ':attribute должно быть между :min и :max пунктов.',
    ],
    'boolean' => ':attribute поле должно быть истинным или ложным.',
    'confirmed' => ':attribute подтверждение не соответствует.',
    'date' => ':attribute не является допустимой датой.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и :other должны быть разными.',
    'digits' => ':attribute должо быть :digits цифр.',
    'digits_between' => ':attribute должно быть между :min и :max цифр.',
    'distinct' => ':attribute поле имеет повторяющееся значение.',
    'email' => ':attribute адрес эл. почты должен быть действительным.',
    'exists' => 'Выбранный :attribute недействителен.',
    'filled' => ':attribute поле, обязательное для заполнения.',
    'image' => ':attribute должно быть изображением',
    'in' => 'Выбранный :attribute недействителен',
    'in_array' => ':attribute поле не существует в :other.',
    'integer' => ':attribute должен быть целым числом.',
    'ip' => ':attribute должен быть действительным IP-адресом.',
    'json' => ':attribute должна быть действительной строкой JSON.',
    'max' => [
        'numeric' => ':attribute не может быть больше :max.',
        'file' => ':attribute не может быть больше :max килобайт.',
        'string' => ':attribute не может быть больше :max символов.',
        'array' => ':attribute mне может быть больше :max пунктов.',
    ],
    'mimes' => ':attribute должен быть файлом типа: :values.',
    'min' => [
        'numeric' => ':attribute должен быть не менее :min.',
        'file' => ':attribute должен быть не менее :min килобайт.',
        'string' => ':attribute должен быть не менее :min символов.',
        'array' => ':attribute должен быть не менее :min пунктов.',
    ],
    'not_in' => 'Выбранный :attribute недействителен.',
    'numeric' => ':attribute должен быть числом.',
    'present' => ':attribute поле должно присутствовать.',
    'regex' => 'Формат :attribute недействителен.',
    'required' => ':attribute поле, обязательное для заполнения.',
    'required_if' => ':attribute поле требуется, когда :other является :value.',
    'required_unless' => ':attribute поле требуется, если :other в :values.',
    'required_with' => ':attribute поле требуется, когда :values представлено.',
    'required_with_all' => ':attribute поле требуется, когда :values представлено.',
    'required_without' => ':attribute поле требуется, когда :values не представлено.',
    'required_without_all' => ':attribute поле требуется, когда не представлено ни одно из :values.',
    'same' => ':attribute и :other должны соответствовать.',
    'size' => [
        'numeric' => ':attribute должно быть :size.',
        'file' => ':attribute должно быть :size килобайт.',
        'string' => ':attribute должно быть :size символов.',
        'array' => ':attribute должно быть :size пунктов.',
    ],
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должна быть действительной зоной.',
    'unique' => ':attribute уже был взят.',
    'url' => ':attribute формат недействителен.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
