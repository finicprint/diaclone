<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

use Diaclone\Transformer\AbstractTransformer;

interface ResourceInterface
{
    public function getData();

    public function getPropertyName();

    public function transform(AbstractTransformer $transformer);

    public function untransform(AbstractTransformer $transformer);
}