<?php
namespace WpEngine\Model;

use ORMTalk\Orm\MapperAbstract;
use ORMTalk\Orm\DomainObjectAbstract;
use League\Csv\Reader;
use Exception;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

class AccountsMapper extends MapperAbstract
{
    protected function createInstance()
    {
        return new Accounts;
    }

    public function populate(DomainObjectAbstract $obj, array $data)
    {
        $obj->setId(isset($data['Account ID']) ? $data['Account ID'] : null);
        $obj->accountName = (isset($data['Account Name']) ? $data['Account Name'] : null);
        $obj->status = isset($data['status']) ? $data['status'] : null;
        $obj->creation = isset($data['Created On'])? $data['Created On'] : null;

        return $obj;
    }

    public function getFromId($id)
    {
        $data = $this->getCsv($id);

        return $this->create($data);
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

    private function getStatus($accountId)
    {
        $client = new Guzzle(
            [
                'base_uri' => 'https://interview.wpengine.io/v1/'
            ]
        );

        $res = $client->get('accounts/' . $accountId);
        if ($res->getStatusCode() == '200') {
            $contents = $res->getBody()->getContents();
            return $contents;
        }
    }

    private function getCsv($id = null)
    {
        $csv = Reader::createFromPath(__DIR__ . '/../asset/input.csv');

        $headers = $csv->fetchOne();

        $accounts = $csv->setOffset(1)->fetchAssoc($headers);

        if ($id) {
            foreach ($accounts as $key => $value) {

                if ($id['account_id'] == $value['Account ID']) {
                    return $accounts[$key];
                }
            }
            throw new Exception('Account doesn\'t exist');
        }

        return $accounts;
    }
}
