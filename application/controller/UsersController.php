<?php
namespace OrmTalk\Controller;

use OrmTalk\Model\AccountsMapper;

class DataMapperController
{
    public static function all()
    {
        return 'all';
    }

    public static function get($accountId)
    {
        $accountMapper = new AccountsMapper();

        $account = $accountMapper->getFromId($accountId);

        return [
            'DataMapper' => $account->toArray()
        ];
    }
}
