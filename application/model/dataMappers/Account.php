<?php
namespace ORMTalk\Model;

use ORMTalk\Orm\DomainObjectAbstract;

class Account extends DomainObjectAbstract
{

    public $id;
    public $user_id;
    public $status;

    public function toArray()
    {
        return   [
            'account_id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ];
    }

    public function toJson()
    {
        return json_encode(
            $this->toArray()
        );
    }
}
