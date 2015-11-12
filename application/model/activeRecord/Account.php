<?php
namespace OrmTalk\Model\ActiveRecord;

use Illuminate\Database\Capsule\Manager as Capsule;

class Account
{
    const TABLE = 'accounts';

    public $id;
    public $user_id;
    public $status;
    public $last_updated;
    public $created;


    public function save()
    {
        if ($this->id) {
            $this->update();
            return $this;
        }

        $this->insert();
        return $this;
    }

    private function update()
    {
        $this->last_updated = Date('Y-m-d H:i:s');
        $args = get_object_vars($this);
        array_filter($args);
        Capsule::table(self::TABLE)->where('id', $this->id)
            ->update($args);
    }

    private function insert()
    {
        $this->last_updated = time();
        $this->created = time();
        $args = get_object_vars($this);
        array_filter($args);
        Capsule::table(self::TABLE)->insert($args);
    }

    public function find($id)
    {
        $data = Capsule::table(self::TABLE)->where('id', $id)->first();
        $this->hydrate((array) $data);
        return $this;
    }

    public function hydrate($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
        $this->status  = (isset($data['status'])) ? $data['status'] : null;
        $this->created = (isset($data['created'])) ? $data['created'] : null;
        $this->last_updated = (isset($date['last_updated'])) ? $data['last_updated'] : null;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
