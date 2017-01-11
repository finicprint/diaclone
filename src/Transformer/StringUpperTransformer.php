<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class StringUpperTransformer extends StringTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return strtoupper(parent::transform($resource));
    }

    public function untransform(ResourceInterface $resource)
    {
        return strtoupper(parent::untransform($resource));
    }
}