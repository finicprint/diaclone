<?php
declare(strict_types = 1);

namespace Diaclone;

use Diaclone\Resource\Item;
use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Serializer\ArraySerializer;
use Diaclone\Serializer\SerializerAbstract;

class TransformService
{
    /** @var int */
    protected $recursionLimit;

    /** @var \Diaclone\Serializer\SerializerAbstract */
    protected $serializer;

    public function __construct(SerializerAbstract $serializer = null, int $recursionLimit = 10)
    {
        $this->recursionLimit = $recursionLimit;
        $this->serializer = $serializer ? $serializer : new ArraySerializer();
    }

    public function transform($data, AbstractTransformer $transformer, $key = '', $fieldMap = '*', $resourceClass = Item::class): array
    {
        $resource = new $resourceClass($data, '', $fieldMap);
        $transformed = $transformer->transform($resource);

        return '' === $key ? $transformed : [$key => $transformed];
    }

    public function untransform($data, AbstractTransformer $transformer, $resourceClass = Item::class): array
    {
        $resource = new $resourceClass($data);

        return $transformer->untransform($resource);
    }
}