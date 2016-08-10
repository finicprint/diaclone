<?php
declare(strict_types = 1);

namespace Diaclone;

use Diaclone\Transformers\AbstractTransformer;
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

    public function transform($data, AbstractTransformer $transformer, $key = 'data', $fieldMap = '*'): array
    {
        $transformed = $transformer->transform($data, '', $fieldMap);

        return [$key => $transformed];
    }

    public function untransform($data, $transformer): array
    {
        return $data;
    }
}