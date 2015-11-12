<?php
namespace OrmTalk\Controller;

use OrmTalk\Model\DataMapper\AccountsMapper;
use OrmTalk\Model;

class AccountsController
{
    public function all()
    {
        return 'all';
    }

    public function get($user_id)
    {

        return [
                'dataMapper' => $this->dataMapper($user_id),
                'activeRecord' => $this->activeRecord($user_id),
                'doctrine' => $this->doctrine($user_id),
                'eloquent' => $this->eloquent($user_id)
            ];
    }

    private function dataMapper($user_id)
    {
        $accountsMapper = new AccountsMapper;

        $account = $accountsMapper->getFromId($user_id);

        $account->status = 'Failed To Pay';

        $accountsMapper->update($account);

        return $account->toArray();
    }

    private function activeRecord($user_id)
    {
        $account = new Model\ActiveRecord\Account;

        $account->find($user_id);

        $account->status = 'Good';

        $account->save();

        return $account->toArray();
    }

    private function doctrine($user_id)
    {
        $account = $GLOBALS['entityManager']->find('OrmTalk\Model\Doctrine\Account', $user_id);

        return $account;
    }

    private function eloquent($user_id)
    {
        $account = Model\Eloquent\Account::find($user_id);

        $account->deleted = 1;

        $account->save();

        return $account;
    }
}
