<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * Class User
 * @package App\Entity
 */
#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type:'string', length: 180, unique:true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type:'string')]
    private string $password;

    #[ORM\Column(type: 'string', length: 100, unique:true)]
    private string $username;

    /**
     * @param  string $email
     * @param  string $password
     * @param  string $username
     * @return self
     */
    public static function create(string $email, string $username): self
    {
        $user = new self();
        $user->email = $email;
        $user->roles = ["ROLE_USER"];
        $user->username = $username;

        return $user;
    }

    /**
     * Get the value of id
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

     /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
 
        return array_unique($roles);
    }

    /**
     * @param  array $roles
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
 
        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function eraseCredentials()
    {
        // TODO
    }


    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->email;
    }
}