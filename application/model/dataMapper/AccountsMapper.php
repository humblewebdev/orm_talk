<?php
namespace OrmTalk\Model\DataMapper;

use OrmTalk\Orm\MapperAbstract;
use OrmTalk\Orm\DomainObjectAbstract;
use Illuminate\Database\Capsule\Manager as Capsule;

class AccountsMapper extends MapperAbstract
{
    Const TABLE = 'accounts';

    protected function createInstance()
    {
        return new Account;
    }

    public function populate(DomainObjectAbstract $obj, array $data)
    {
        $obj->id = (isset($data['id'])) ? $data['id'] : null;
        $obj->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
        $obj->status  = (isset($data['status'])) ? $data['status'] : null;
        $obj->created = (isset($data['created'])) ? $data['created'] : null;
        $obj->last_updated = (isset($date['last_updated'])) ? $data['last_updated'] : null;
        return $obj;
    }

    public function getFromId($id)
    {
        $data = Capsule::table(self::TABLE)->where('user_id', $id)
            ->where('deleted', '!=', 1)
            ->first();

        return $this->create((array) $data);
    }

    public function get()
    {
        $data = Capsule::table(self::Table)
            ->where('deleted', '!=', 1)
            ->get();
    }

    public function insert(DomainObjectAbstract $obj)
    {
        Capsule::table(self::TABLE)->insert($obj->toArray());
    }

    public function update(DomainObjectAbstract $obj)
    {
        Capsule::table(self::TABLE)->where('id', $obj->id)
            ->update($obj->toArray());
    }

    protected function deleteInstance(DomainObjectAbstract $obj)
    {
        Capsule::table(self::TABLE)->where('id', $obj->id)
            ->update(['deleted' => 1]);
    }

}
