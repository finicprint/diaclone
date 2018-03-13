<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Exception\MalformedInputException;
use Diaclone\Exception\TransformException;
use Diaclone\Resource\Item;
use Diaclone\Resource\ResourceInterface;
use Exception;

class StringTransformer extends AbstractTransformer
{
    protected $transformerClasses = [
        EmojiCharactersTransformer::class,
        HtmlCharactersTransformer::class,
        NonPrintableCharactersTransformer::class,
    ];

    public function transform(ResourceInterface $resource)
    {
        try {
            foreach ($this->transformerClasses as $transformerClass) {
                $transformer = new $transformerClass();
                $resource = new Item($transformer->transform($resource));
            }

            return (string)$this->getPropertyValueFromResource($resource);

        } catch (Exception $exception) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName(), 0, $exception);
        }
    }

    public function untransform(ResourceInterface $resource)
    {
        try {
            foreach ($this->transformerClasses as $transformerClass) {
                $transformer = new $transformerClass();
                $resource = new Item($transformer->untransform($resource));
            }

            return (string)$resource->getData();

        } catch (Exception $exception) {
            throw new MalformedInputException([$resource->getPropertyName(), 'String expected']);
        }
    }
}
