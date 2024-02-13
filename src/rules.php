<?php

return [
    '@Symfony' => true,
    'binary_operator_spaces' => [
        'operators' => [
            '=>' => 'single_space',
        ]
    ],
    'types_spaces' => [
        'space' => 'single'
    ],
    'array_syntax' => ['syntax' => 'short'],
    'linebreak_after_opening_tag' => true,
    'not_operator_with_successor_space' => true,
    'ordered_imports' => true,
    'phpdoc_order' => true,
    'yoda_style' => false,
    'compact_nullable_typehint' => true,
    'declare_strict_types' => true,
    'explicit_indirect_variable' => true,
    'explicit_string_variable' => false,
    'fully_qualified_strict_types' => true,
    'list_syntax' => ['syntax' => 'short'],
    'method_chaining_indentation' => true,
    'no_useless_else' => true,
    'ordered_class_elements' => [
        'order' => [
            'use_trait',
            'constant_public',
            'constant_protected',
            'constant_private',
            'case',
            'property_public_static',
            'property_protected_static',
            'property_private_static',
            'property_public',
            'property_protected',
            'property_private',
            'construct',
            'destruct',
            'phpunit',
            'method_protected_static',
            'method_private_static',
            'method_public',
            'method_protected',
            'method_private',
            'magic',
        ],
    ],
    'concat_space' => ['spacing' => 'one'],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
    ],
    'phpdoc_line_span' => [
        'const' => 'single',
        'method' => 'multi',
        'property' => 'single',
    ],
    'php_unit_method_casing' => [
        'case' => 'snake_case',
    ],
    'php_unit_test_case_static_method_calls' => [
        'call_type' => 'self',
    ],
    'global_namespace_import' => [
        'import_classes' => true,
        'import_constants' => true,
        'import_functions' => null,
    ],
    'nullable_type_declaration_for_default_null_value' => false,
];