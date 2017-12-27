<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Resource\Collection;
use Diaclone\Resource\Object;
use Diaclone\Resource\ObjectCollection;

abstract class AbstractObjectTransformer extends AbstractTransformer
{
    abstract public function getObjectClass(): string;
}
