<?php
namespace ORMTalk\Model\DataMapper;

use OrmTalk\Orm\DomainObjectAbstract;

class Account extends DomainObjectAbstract
{

    public $id;
    public $user_id;
    public $status;
    public $last_updated;
    public $created;

    public function toArray()
    {
        return   [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'last_updated' => $this->last_updated,
            'created' => $this->created
        ];
    }

    public function toJson()
    {
        return json_encode(
            $this->toArray()
        );
    }
}
