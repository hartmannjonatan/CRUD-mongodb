<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @MongoDB\Document(collection="clientes")
 */
class Cliente
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $nome;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $genero;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $cpf;

    /**
     * @MongoDB\Field(type="int")
     * @Assert\NotBlank()
     */
    protected $telefone;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $senha;

    /**
     * @MongoDB\Field(type="bool")
     */
    protected $notif_whats;

    /**
     * @MongoDB\Field(type="bool")
     */
    protected $emails_promocionais;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @MongoDB\Field(type="date")
     * @Assert\NotBlank()
     */
    protected $dataNasc;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {   
        $this->telefone = $telefone;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {   
        $this->senha = $senha;
    }

    public function getNotifWhats()
    {
        return $this->notif_whats;
    }

    public function setNotifWhats($notif_whats)
    {
        $this->notif_whats = $notif_whats;
    }

    public function getEmailsPromocionais()
    {
        return $this->emails_promocionais;
    }

    public function setEmailsPromocionais($emails_promocionais)
    {
        $this->emails_promocionais = $emails_promocionais;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    public function setDataNasc(\DateTimeInterface $dataNasc)
    {
        $this->dataNasc = $dataNasc; 
    }
}