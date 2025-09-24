<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Contracts;

interface Entity extends Makeable {
    /**
     * @return \Condividendo\FatturaPA\Contracts\Tag
     *
     * @noinspection PhpMissingReturnTypeInspection
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint
     */
    public function getTag();
}
