<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PostArticle
 * @package App\Entity
 *  
 */
#[ORM\Entity()]
class PostArticle{
     
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;
    
    #[ORM\Column(type: 'text')]
    private string $content;

    /**
     *
     * @var DateTimeInterface
     */
    #[ORM\Column(type: 'datetime_immutable',  options:["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeInterface $publishedAt;


    /**
     *
     * @var User[]
     */
    #[ORM\ManyToMany(targetEntity: 'User')]
    #[ORM\JoinTable(name:"post_likes")]
    private array $likedby;

    /**
     * PostArticle Immutable
     */
    public function __construct()
    {
        $this->publishedAt = new \DateTimeImmutable();
    }

    /**
     * Get the value of id
     *
     * @return  integer|null
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }


    /**
     * Get the value of publishedAt
     *
     * @return  DateTimeInterface
     */ 
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     *
     * @param  DateTimeInterface  $publishedAt
     *
     * @return  self
     */ 
    public function setPublishedAt(DateTimeInterface $publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get the value of likedby
     *
     * @return  User[]
     */ 
    public function getLikedby()
    {
        return $this->likedby;
    }

    /**
     * Set the value of likedby
     *
     * @param  User[]  $likedby
     *
     * @return  self
     */ 
    public function setLikedby(array $likedby)
    {
        $this->likedby = $likedby;

        return $this;
    }
}