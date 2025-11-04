<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Condividendo\FatturaPA\Tags\ArticleCode as ArticleCodeTag;
use Condividendo\FatturaPA\Traits\Makeable;

class ArticleCode extends Entity {
    use Makeable;

    private string $type;

    private string $value;

    public function type(string $type): self {
        $this->type = $type;

        return $this;
    }

    public function value(string $value): self {
        $this->value = $value;

        return $this;
    }

    public function getTag(): ArticleCodeTag {
        return ArticleCodeTag::make()
            ->setType($this->type)
            ->setValue($this->value);
    }
}
