<?php

namespace App\Entity;

use DateTimeInterface;

/**
 * Class PostArticles
 * @package App\Entity
 *  
 */
class PostArticles{
     /**
     *
     * @var integer|null
     */
    private ?int $id;
    
    private string $content;

    /**
     *
     * @var DateTimeInterface
     */
    private DateTimeInterface $publishedAt;

    /**
     *
     * @var User
     */
    private User $author;

    /**
     *
     * @var User[]
     */
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
     * Get the value of author
     *
     * @return  User
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param  User  $author
     *
     * @return  self
     */ 
    public function setAuthor(User $author)
    {
        $this->author = $author;

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