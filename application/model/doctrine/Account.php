<?php
namespace OrmTalk\Model\Doctrine;

/*
 * @Entity @Table(name="accounts")
 */
class Account
{
    /*
     * @Id @column(type="integer") @GeneratedValue
     */
    protected $id;

    /*
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $user_id;

    /*
     * @Column(type="string")
     */
    protected $status;

    /*
     * @Column(type="timestamp")
     */
    protected $last_updated;

    /*
     * @Column(type="timestamp")
     */
    protected $created;

    /*
     * @Column(type="tinyinteger")
     */
    protected $deleted;
}
