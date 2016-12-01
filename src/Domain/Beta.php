<?php
/**
 * Created by PhpStorm.
 * User: POL
 * Date: 28/11/2016
 * Time: 21:45
 */

namespace Push\Domain;


class Beta
{
    /**
     * Beta id
     *
     * @var integer
     */
    private $id;

    /**
     * Beta user mail
     *
     * @var string
     */
    private $mail;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
}