<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

class FieldMap implements FieldMapInterface
{
    private $partials;
    private $wildcard;

    /**
     * FieldMap constructor.
     *
     * @param $partials
     * @param $wildcard
     */
    public function __construct($partials = [], $wildcard = false)
    {
        if (is_string($partials)) {
            if ($partials === '*') {
                $partials = [];
                $wildcard = true;
            } else {
                $partials = [$partials];
            }
        }

        $this->partials = $partials;
        $this->wildcard = $wildcard;
    }

    /**
     * @return bool
     */
    public function isWildcard()
    {
        return boolval($this->wildcard);
    }

    /**
     * @return array
     */
    public function getPartials()
    {
        return $this->partials;
    }

    /**
     * @return string
     */
    public function getPartial($partial)
    {
        return (isset($this->partials[$partial])) ? $this->partials[$partial] : null;
    }

    /**
     * @param $field
     *
     * @return mixed
     */
    public function addPartial($field)
    {
        if (! $this->hasPartial($field)) {
            $this->partials[] = $field;
        }
    }

    /**
     * @param $field
     *
     * @return array
     */
    public function removePartial($field)
    {
        $this->partials = array_diff($this->partials, [$field]);
    }

    /**
     *  has partial
     *
     * @param $partial
     *
     * @return bool
     */
    public function hasPartial($partial)
    {
        return $this->isWildcard() || in_array($partial, $this->getPartials());
    }

    /**
     *  Check if partial map is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return (empty($this->getPartials()) && ! boolval($this->isWildcard()));
    }

    /**
     * @param boolean $wildcard
     *
     * @return $this
     */
    public function setWildcard($wildcard)
    {
        $this->wildcard = $wildcard;

        return $this;
    }
}