<?php
declare(strict_types = 1);

namespace Diaclone;

use Diaclone\Resource\Collection;
use Diaclone\Connector\Connector;
use Diaclone\Resource\Item;
use Diaclone\Serializer\ArraySerializer;
use Diaclone\Serializer\SerializerAbstract;
use Diaclone\Transformer\AbstractTransformer;

class ConnectorTransformService
{
    /** @var int */
    protected $recursionLimit;

    /** @var \Diaclone\Serializer\SerializerAbstract */
    protected $serializer;

    public function __construct(SerializerAbstract $serializer = null, int $recursionLimit = 10)
    {
        $this->recursionLimit = $recursionLimit;
        $this->serializer = $serializer ?: new ArraySerializer();
    }

    public function transform(Connector $connectorIn, Connector $connectorOut, AbstractTransformer $transformer, $key = '', $fieldMap = '*', $resourceClass = Item::class)
    {
        $resource = new $resourceClass($connectorIn->getData(), '', $fieldMap);
        $transformed = $transformer->transform($resource);

        if ($resource instanceof Collection) {
            $serialized = $this->serializer->collection($key, $transformed);

        } else {
            $serialized = $this->serializer->item($key, $transformed);
        }

        return $serialized;
    }

    public function untransform($data, AbstractTransformer $transformer, $resourceClass = Item::class): array
    {
        $resource = new $resourceClass($data);

        return $transformer->untransform($resource);
    }

    public function save() {

    }
}