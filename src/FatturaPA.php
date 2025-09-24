<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA;

class FatturaPA {
    public static function build(): FatturaPABuilder {
        return new FatturaPABuilder;
    }
}
