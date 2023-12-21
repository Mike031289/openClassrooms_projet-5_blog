<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/app')
;

return (new PhpCsFixer\Config())
    ->setUsingCache(false)
    ->setRules([
        '@DoctrineAnnotation'       => true,
        '@PHP71Migration'           => true,
        '@PHP71Migration:risky'     => true,
        '@PHPUnit60Migration:risky' => true,
        '@Symfony'                  => true,
        '@Symfony:risky'            => true,
        'void_return'               => false, // Enforce by @PHP71Migration:risky but can break method definition for libraries
        'non_printable_character'   => false,
        'align_multiline_comment'   => ['comment_type' => 'phpdocs_only'],
        'array_indentation'         => true,
        'braces'                    => ['allow_single_line_closure' => true],
        'compact_nullable_typehint' => true,
        'fopen_flags'               => ['b_mode' => true],
        'no_extra_blank_lines'      => [
            'tokens' => [
                'break',
                'continue',
                'curly_brace_block',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'throw',
                'use',
            ],
        ],
        'no_useless_else'   => true,
        'no_useless_return' => true,
        'ordered_imports'   => [
            'imports_order' => [
                'class',
                'function',
                'const',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'php_unit_method_casing' => [
            'case' => 'camel_case',
        ],
        'phpdoc_order'                                     => true,
        'phpdoc_trim_consecutive_blank_line_separation'    => true,
        'strict_comparison'                                => true,
        'strict_param'                                     => true,
        'phpdoc_summary'                                   => false,
        'no_unneeded_final_method'                         => true,
        'concat_space'                                     => ['spacing' => 'none'],
        'multiline_whitespace_before_semicolons'           => ['strategy' => 'new_line_for_chained_calls'],
        'phpdoc_to_comment'                                => false,
        'native_constant_invocation'                       => true,
        'native_function_invocation'                       => ['include' => ['@compiler_optimized']],
        'array_syntax'                                     => ['syntax' => 'short'],
        'declare_strict_types'                             => true,
        'no_whitespace_before_comma_in_array'              => false,
        'binary_operator_spaces'                           => [
            'default'   => 'single_space',
            'operators' => [
                '=>' => 'align',
            ],
        ],
        'self_accessor'                                    => false,
        'php_unit_test_case_static_method_calls'           => ['call_type' => 'self'],
        'types_spaces'                                     => ['space' => 'single'],
        'blank_line_between_import_groups'                 => false,
        'phpdoc_separation'                                => false,
        'global_namespace_import'                          => ['import_classes' => null, 'import_constants' => null, 'import_functions' => null],
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;