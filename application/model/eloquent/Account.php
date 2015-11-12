<?php
namespace OrmTalk\Model\Eloquent;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Account extends Eloquent
{
    protected $table = 'accounts';

    public $timestamps = false;
}
