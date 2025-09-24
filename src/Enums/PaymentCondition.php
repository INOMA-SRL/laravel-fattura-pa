<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Enums;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 *
 * @method static self TP01() A rate
 * @method static self TP02() Unico
 * @method static self TP03() Con anticipo
 */
final class PaymentCondition extends Enum {
    public const string TP01 = 'TP01';

    public const string TP02 = 'TP02';

    public const string TP03 = 'TP03';
}
