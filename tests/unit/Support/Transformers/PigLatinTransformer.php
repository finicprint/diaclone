<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Resource\ResourceInterface;
use Diaclone\Transformer\AbstractTransformer;

class PigLatinTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValue($resource->getData(), 'name');

        if (empty($value)) {
            return '';
        }

        $parts = explode(' ', $value);
        $converted = [];
        foreach ($parts as $part) {
            $firstLetter = lcfirst($part[0]);
            if (in_array($firstLetter, ['a', 'e', 'i', 'o', 'u',])) {
                $converted[] = $part . 'yay';
            } else {
                $pigged = substr($part, 1) . $firstLetter . 'ay';
                if ($firstLetter !== $part[0]) {
                    $pigged = ucfirst($pigged);
                }

                $converted[] = $pigged;
            }
        }

        return implode(' ', $converted);
    }
}