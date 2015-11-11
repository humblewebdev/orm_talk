<?php
namespace OrmTalk\Controller;

use OrmTalk\Model\DataMapper\AccountsMapper;

class AccountsController
{
    public function all()
    {

    }

    public function get($id)
    {
        $accountMapper = new AccountsMapper;
        $account = $accountMapper->getFromId($id);

        return $account->toArray;
    }
}
