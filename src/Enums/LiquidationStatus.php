<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Enums;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 *
 * @method static self LS() la società è in stato di liquidazione.
 * @method static self LN() la società non è in stato di liquidazione.
 */
final class LiquidationStatus extends Enum {
    public const LS = 'LS';

    public const LN = 'LN';
}
