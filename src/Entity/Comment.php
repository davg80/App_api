<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Comment
 * @package App\Entity  
 */
#[ORM\Entity]
#[ORM\Table(name:'comments')]
class Comment{

    /**
     * @var integer|null
     */
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private ?int $id;
    /**
     * @var string
     */
    #[ORM\Column(type:'text')]
    private string $content;
    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: 'datetime_immutable',  options:["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeInterface $date_comment;

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: 'User')]
    private User $author;

    /**
     * @var Article
     */
    #[ORM\ManyToOne(targetEntity: 'Article')]
    #[ORM\JoinColumn(onDelete:'CASCADE')]
    private Article $Article;

    /**
     * @param \DateTimeImmutable $date_comment
     */
    public function __construct()
    {
        $this->date_comment = new \DateTimeImmutable();
    }

    /**
     * @param  string      $content
     * @param  User        $author
     * @param  Article article
     * @return self
     */
    public static function create(string $content, User $author, Article $article): self
    {
        $comment = new self();
        $comment->content = $content;
        $comment->author = $author;
        $comment->article = $article;
        return $comment;
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
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of date_comment
     *
     * @return  \DateTimeInterface
     */ 
    public function getDate_comment()
    {
        return $this->date_comment;
    }

    /**
     * Set the value of date_comment
     *
     * @param  \DateTimeInterface  $date_comment
     *
     * @return  self
     */ 
    public function setDate_comment(\DateTimeInterface $date_comment)
    {
        $this->date_comment = $date_comment;

        return $this;
    }

  

    /**
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of Article
     */ 
    public function getArticle()
    {
        return $this->Article;
    }

    /**
     * Set the value of Article
     *
     * @return  self
     */ 
    public function setArticle($Article)
    {
        $this->Article = $Article;

        return $this;
    }
}