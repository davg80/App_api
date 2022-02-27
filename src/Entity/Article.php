<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Article
 * @package App\Entity
 *  
 */
#[ORM\Entity()]
#[ORM\Table(name:'articles')]
class Article{
     
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("articles")]
    private ?int $id;
    
    #[ORM\Column(type: 'text')]
    #[Groups("articles")]
    #[Assert\NotBlank]
    #[Assert\Length(min:10)]
    private string $content;

    /**
     *
     * @var DateTimeInterface
     */
    #[ORM\Column(type: 'datetime_immutable',  options:["default" => "CURRENT_TIMESTAMP"])]
    #[Groups("articles")]
    private \DateTimeInterface $publishedAt;

    /**
     *
     * @var User[]|Collection
     */
    #[ORM\ManyToMany(targetEntity: 'User')]
    #[ORM\JoinTable(name:"likes")]
    private Collection $likedBy;

    /**
     * Article Immutable
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
        $article = new self();
        $article->content = $content;
        return $article;
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