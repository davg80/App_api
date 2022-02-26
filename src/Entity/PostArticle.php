<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var User[]|Collection
     */
    #[ORM\ManyToMany(targetEntity: 'User')]
    #[ORM\JoinTable(name:"post_likes")]
    private Collection $likedBy;

    /**
     * PostArticle Immutable
     */
    public function __construct()
    {
        $this->publishedAt = new \DateTimeImmutable();
        $this->likedBy = new ArrayCollection();
    }

    /**
     * @param  string $content
     * @return self
     */
    public static function create(string $content): self
    {
        $post = new self();
        $post->content = $content;
        return $post;
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
     * @var User[]|Collection
     */ 
    public function getLikedby(): Collection
    {
        return $this->likedBy;
    }

    /**
     * @param  User $user
     * @return void
     */    
    public function LikeBy(User $user): void
    {
        if($this->likedBy->contains($user)){
            return;
        }
        $this->likedBy->add($user);
    }

    /**
     * @param  User $user
     * @return void
     */
    public function dislikeBy(User $user): void
    {
        if(!$this->likedBy->contains($user)){
            return;
        }
        $this->likedBy->removeElement($user);
    }

}