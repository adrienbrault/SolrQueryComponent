<?php
namespace InterNations\Component\Solr\Expression;

class ParameterExpression extends Expression
{
    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $parameters = array_map([$this, 'replaceNull'], $this->parameters);

        return join(', ', array_map(['InterNations\Component\Solr\Util', 'sanitize'], $parameters));
    }

    private function replaceNull($value)
    {
        return $value === null ? new PhraseExpression('') : $value;
    }
}
