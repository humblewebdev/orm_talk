<?php
namespace OrmTalk\Model\Doctrine;

/**
 * @Entity @Table(name="accounts")
 */
class Account
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="integer")
     */
    protected $user_id;

    /**
     * @Column(type="string")
     */
    protected $status;

    /**
     * @Column(type="datetime")
     */
    protected $last_updated;

    /**
     * @Column(type="datetime")
     */
    protected $created;

    /**
     * @Column(type="smallint")
     */
    protected $deleted;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'last_updated' => $this->last_updated,
            'created' => $this->created,
            'deleted' => $this->deleted
        ];
    }
}
