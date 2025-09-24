<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Enums;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 *
 * @method static self SU() Socio unico
 * @method static self SM() Soci multipli
 */
final class ShareHolder extends Enum {
    public const string SU = 'SU';

    public const string SM = 'SM';
}
