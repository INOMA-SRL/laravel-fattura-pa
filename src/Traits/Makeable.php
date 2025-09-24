<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Traits;

trait Makeable {
    /**
     *
     * @noinspection PhpMissingReturnTypeInspection
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint
     */
    public static function make(): static {
        return new static;
    }
}
