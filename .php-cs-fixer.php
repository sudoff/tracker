<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->name('*.php')
    ->exclude([
        'vendor',
        'runtime',
    ])
    ->notPath('tests/*')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);;

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'binary_operator_spaces' => [
        'default' => 'align_single_space_minimal',
        'operators' => ['=>' => 'align_single_space']
    ],
    'blank_line_after_namespace' => true,
    'blank_line_after_opening_tag' => true,
    'blank_line_before_statement' => ['statements' => ['return']],
    'braces' => [
        'allow_single_line_closure' => true,
        'position_after_anonymous_constructs' => 'same',
        'position_after_control_structures' => 'same',
        'position_after_functions_and_oop_constructs' => 'next'
    ],
    'cast_spaces' => ['space' => 'none'],
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'one',
            'method' => 'one',
            'property' => 'one'
        ]
    ],
    'concat_space' => ['spacing' => 'one'],
    'declare_equal_normalize' => ['space' => 'none'],
    'function_declaration' => ['closure_function_spacing' => 'none'],
    'include' => true,
    'lowercase_keywords' => true,
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline'
    ],
    'no_extra_blank_lines' => [
        'tokens' => [
            'extra',
            'throw',
            'use'
        ]
    ],
    'no_trailing_comma_in_singleline_array' => true,
    'no_whitespace_in_blank_line' => true,
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'phpdoc_align' => ['align' => 'left'],
    'phpdoc_indent' => true,
    'phpdoc_no_alias_tag' => [
        'replacements' => [
            'type' => 'var',
            'link' => 'see'
        ]
    ],
    'phpdoc_scalar' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => false,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'single_quote' => true,
    'trailing_comma_in_multiline' => ['elements' => ['arrays']],
    'whitespace_after_comma_in_array' => true,
])
    ->setFinder($finder);
