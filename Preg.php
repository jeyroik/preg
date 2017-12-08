<?php
namespace jeyroik\tools\components;

/**
 * Class Preg
 * @package gosp\webhooks\components
 * @author JeyRoik <jeyroik@gmail.com>
 */
class Preg
{
    /**
     * @var array
     */
    protected $patterns = [];

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @param $values
     * @return $this
     */
    public function apply($values)
    {
        foreach ($values as $entity => $fields) {
            foreach ($fields as $name => $value) {
                if (is_array($value)) {
                    $this->apply([$this->escapeField($entity . '.' . $name) => $value]);
                } elseif (is_object($value)) {
                    $this->apply([$this->escapeField($entity . '.' . $name) => (array) $value]);
                } else {
                    $this->patterns[] = $entity ? $this->makeFieldPattern($entity, $name) : $this->makePattern($name);
                    $this->values[] = $value;
                }
            }
        }
        
        return $this;
    }

    /**
     * @param $template
     * @return mixed
     */
    public function to($template)
    {
        $result = preg_replace($this->patterns, $this->values, $template);

        $this->patterns = [];
        $this->values = [];

        return $result;
    }

    /**
     * @param $entity
     * @param $field
     * @return string
     */
    protected function makeFieldPattern($entity, $field)
    {
        return '/\@' . $entity . '\.' . $field . '/i';
    }

    /**
     * @param $field
     * @return string
     */
    protected function makePattern($field)
    {
        return '/\@' . $field . '/i';
    }

    /**
     * @param $field
     * @return mixed
     */
    protected function escapeField($field)
    {
        return preg_replace(['/\@/i', '/\./i'], ['\\@', '\\.'], $field);
    }
}
