<?php
namespace OrmTalk\Orm;

abstract class DomainObjectAbstract
{
    protected $id = null;
    protected $uuid = null;
    /**
     * Get the ID of this object (unique to the object type)
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id for this object.
     *
     * @param int $id
     * @return int
     * @throws Exception If the id on the object is already set
     */
    public function setId($id)
    {
        if (!is_null($this->id)) {
            throw new Exception('ID is immutable');
        }
        return $this->id = $id;
    }

}
