<?php

namespace Phlame\Core\Models;

class SqliteSequence extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $seq;

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field seq
     *
     * @param string $seq
     * @return $this
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;

        return $this;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field seq
     *
     * @return string
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SqliteSequence[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SqliteSequence
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sqlite_sequence';
    }

}
