<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorLaravel\Set\LaravelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/src',
    ])
    ->withPhpSets(php84: true)
// ->withSets([
//     LaravelSetList::LARAVEL_CODE_QUALITY,
//     LaravelSetList::LARAVEL_COLLECTION,
//     LaravelSetList::LARAVEL_120,
// ])
    ->withPreparedSets(
        deadCode: true,
        // codeQuality: true,
        typeDeclarations: true,
        // privatization: true,
        // instanceOf: true,
        // earlyReturn: true,
        // strictBooleans: true,
        rectorPreset: true,
    );
