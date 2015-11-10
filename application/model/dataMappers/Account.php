<?php
namespace ORMTalk\Model;

use ORMTalk\Orm\DomainObjectAbstract;

class Account extends DomainObjectAbstract
{

    public $id;
    public $status;
    public $created;

    public function toArray()
    {
        return   [
            'account_id' => $this->id,
            'status' => $this->status,
            'created_on' => $this->creation
        ];
    }

    public function toJson()
    {
        return json_encode(
            $this->toArray()
        );
    }
}
