<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

interface ResourceInterface
{
    public function getData();

    public function getPropertyName();
}