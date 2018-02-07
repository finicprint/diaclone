<?php
declare(strict_types=1);

namespace Test\Unit\Support\Entities;

class Profile
{
    /** @var ColorType */
    protected $favoriteColor;

    public function getFavoriteColor(): ColorType
    {
        return $this->favoriteColor;
    }

    public function setFavoriteColor(ColorType $favoriteColor): Profile
    {
        $this->favoriteColor = $favoriteColor;

        return $this;
    }
}