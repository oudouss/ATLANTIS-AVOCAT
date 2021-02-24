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

    'accepted' => 'Le champ :attribute doit être accepté.',
    'active_url' => 'Le champ :attribute n\'est pas une URL valide.',
    'after' => 'Le champ :attribute doit être une date après :date.',
    'after_or_equal' => 'Le champ :attribute doit être une date postérieure ou égale à :date.',
    'alpha' => 'Le champ :attribute ne peut contenir que des lettres.',
    'alpha_dash' => 'Le champ :attribute ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num' => 'Le champ :attribute ne peut contenir que des lettres et des chiffres,',
    'array' => 'Le champ :attribute doit être un tableau.',
    'before' => 'Le champ :attribute doit être une date antérieure :date.',
    'before_or_equal' => 'Le champ :attribute doit être une date antérieure ou égale to :date.',
    'between' => [
        'numeric' => 'Le champ :attribute doit être entre :min et :max.',
        'file' => 'Le champ :attribute doit être entre :min et :max kilobytes.',
        'string' => 'Le champ :attribute doit être entre :min et :max caractères.',
        'array' => 'Le champ :attribute doit être entre :min et :max éléments.',
    ],
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed' => 'Le champ:attribute confirmation does not match.',
    'date' => 'Le champ :attribute is not a valid date.',
    'date_equals' => 'Le champ :attribute must be a date equal to :date.',
    'date_format' => 'Le champ:attribute does not match the format :format.',
    'different' => 'Le champ :attribute and :other must be different.',
    'digits' => 'Le champ :attribute must be :digits digits.',
    'digits_between' => 'Le champ :attribute must be between :min and :max digits.',
    'dimensions' => 'Le champ :attribute has invalid image dimensions.',
    'distinct' => 'Le champ :attribute field has a duplicate value.',
    'email' => 'Le champ :attribute must be a valid email address.',
    'ends_with' => 'Le champ :attribute must end with one of the following: :values.',
    'exists' => 'Le champ sélectionné :attribute n\'est pas valide.',
    'file' => 'Le champ :attribute doit être un fichier.',
    'filled' => 'Le champ :attribute field doit avoir une valeur.',
    'gt' => [
        'numeric' => 'Le champ :attribute doit être supérieur à :value.',
        'file' => 'Le champ :attribute doit être supérieur à :value kilobytes.',
        'string' => 'Le champ :attribute doit être supérieur à :value caractères.',
        'array' => 'Le champ :attribute doit avoir plus de :value éléments.',
    ],
    'gte' => [
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :value.',
        'file' => 'Le champ :attribute doit être supérieur ou égal à :value kilobytes.',
        'string' => 'Le champ :attribute doit être supérieur ou égal à :value caractères.',
        'array' => 'Le champ :attribute doit avoir :value éléments ou plus.',
    ],
    'image' => 'Le champ :attribute doit être une image.',
    'in' => 'Le champ :attribute choisi est invalide.',
    'in_array' => 'Le champ :attribute le champ n\'existe pas dans :other.',
    'integer' => 'Le champ :attribute Doit être un entier.',
    'ip' => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4' => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6' => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json' => 'Le champ :attribute doit être une chaîne JSON valide.',
    'lt' => [
        'numeric' => 'Le champ :attribute doit être inférieur à :value.',
        'file' => 'Le champ :attribute doit être inférieur à :value kilobytes.',
        'string' => 'Le champ :attribute doit être inférieur à :value caractères.',
        'array' => 'Le champ :attribute doit plus petit que :value.',
    ],
    'lte' => [
        'numeric' => 'Le champ :attribute doit être inférieur ou égal à :value.',
        'file' => 'Le champ :attribute doit être inférieur ou égal à :value kilobytes.',
        'string' => 'Le champ :attribute doit être inférieur ou égal à :value caractères.',
        'array' => 'Le champ :attribute ne doit pas avoir plus de :value éléments.',
    ],
    'max' => [
        'numeric' => 'Le champ :attribute ne doit pas être supérieur à :max.',
        'file' => 'Le champ :attribute ne doit pas être supérieur à :max kilobytes.',
        'string' => 'Le champ :attribute ne doit pas être supérieur à :max caractères.',
        'array' => 'Le champ :attribute ne doit pas avoir plus de :max éléments.',
    ],
    'mimes' => 'Le champ :attribute doit être un fichier de type: :values.',
    'mimetypes' => 'Le champ :attribute doit être un fichier de type: :values.',
    'min' => [
        'numeric' => 'Le champ :attribute doit être au moins :min.',
        'file' => 'Le champ :attribute doit être au moins :min kilobytes.',
        'string' => 'Le champ :attribute doit être au moins :min caractères.',
        'array' => 'Le champ :attribute doit avoir au moins :min éléments.',
    ],
    'not_in' => 'Le champ :attribute sélectionné est invalide.',
    'not_regex' => 'Le format du champ :attribute est invalide.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ :attribute doit être présent.',
    'regex' => 'Le format du champ :attribute est invalide.',
    'required' => 'Le champ :attribute est requis.',
    'required_if' => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless' => 'Le champ :attribute est requis sauf si :other est dans :values.',
    'required_with' => 'Le champ :attribute est requis lorsque :values est présente.',
    'required_with_all' => 'Le champ :attribute est requis lorsque :values sont présentes.',
    'required_without' => 'Le champ :attribute est requis lorsque :values n\'est pas présente.',
    'required_without_all' => 'Le champ :attribute est requis lorsqu\'aucune des :values: n\'est présente.',
    'same' => 'Le champ :attribute doit correspondre à :other.',
    'size' => [
        'numeric' => 'Le champ :attribute doit être :size.',
        'file' => 'Le champ :attribute doit être :size kilobytes.',
        'string' => 'Le champ :attribute doit être :size caractères.',
        'array' => 'Le champ :attribute doit contenir :size éléments.',
    ],
    'starts_with' => 'Le champ :attribute doit commencer par l\'un des éléments suivants: :values.',
    'string' => 'Le champ :attribute doit être une chaîne.',
    'timezone' => 'Le champ :attribute doit être une zone valide.',
    'unique' => 'Le champ :attribute a déjà été pris.',
    'uploaded' => 'Le champ :attribute n\'a pas pu être téléchargé.',
    'url' => 'Le format du champ :attribute n\'est pas valide.',
    'uuid' => 'Le champ :attribute doit être un UUID valide.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
     */

    'attributes' => [],

];
