<?php
namespace OrmTalk\Model\DataMapper;

use ORMTalk\Orm\MapperAbstract;
use ORMTalk\Orm\DomainObjectAbstract;
use Illuminate\Database\Capsule\Manger as Capsule;

class AccountsMapper extends MapperAbstract
{
    protected function createInstance()
    {
        return new Accounts;
    }

    public function populate(DomainObjectAbstract $obj, array $data)
    {
        $obj->id = $data['id'];
        $obj->user_id = $data['user_id'];
        $obj->status  = $data['status'];
        return $obj;
    }

    public function getFromId($id)
    {
        $data = Capsule::table('accounts')->where('user_id', $id)
            ->first();

        return $this->create((array) $data);
    }

    public function insert(DomainObjectAbstract $obj)
    {
    }

    public function update(DomainObjectAbstract $obj)
    {

    }

    protected function deleteInstance(DomainObjectAbstract $obj)
    {
    }

}
