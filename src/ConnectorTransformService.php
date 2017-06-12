<?php
declare(strict_types = 1);

namespace Diaclone;

use Diaclone\Resource\Collection;
use Diaclone\Connector\Connector;
use Diaclone\Resource\Item;
use Diaclone\Resource\Object;
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

    public function transform(Connector $connector, AbstractTransformer $transformer, $key = '', $fieldMap = '*', $resourceClass = Object::class)
    {
        $resource = new $resourceClass($connector->getData(), '', $fieldMap);
        $transformed = $transformer->transform($resource);

        if ($resource instanceof Collection) {
            $connector->sendDataToSource($transformed);
        } else {
            $connector->sendDataToSource($transformed);
        }
    }

    public function untransform(Connector $connector, AbstractTransformer $transformer, $resourceClass = Object::class)
    {
        $resource = new $resourceClass($connector->getDataFromSource());

        $connector->setData($transformer->untransform($resource));
    }
}
