<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 * @package App\Entity  
 */
#[ORM\Entity]
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
     * @var PostArticle
     */
    #[ORM\ManyToOne(targetEntity: 'PostArticle')]
    #[ORM\JoinColumn(onDelete:'CASCADE')]
    private PostArticle $postArticle;

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
     * @param  PostArticle $post_article
     * @return self
     */
    public static function create(string $content, User $author, PostArticle $post_article): self
    {
        $comment = new self();
        $comment->content = $content;
        $comment->author = $author;
        $comment->post_article = $post_article;
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
     * Get the value of post_article
     *
     * @return  PostArticle
     */ 
    public function getPost_article()
    {
        return $this->post_article;
    }

    /**
     * Set the value of post_article
     *
     * @param  PostArticle  $post_article
     *
     * @return  self
     */ 
    public function setPost_article(PostArticle $post_article)
    {
        $this->post_article = $post_article;

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
     * Get the value of postArticle
     */ 
    public function getPostArticle()
    {
        return $this->postArticle;
    }

    /**
     * Set the value of postArticle
     *
     * @return  self
     */ 
    public function setPostArticle($postArticle)
    {
        $this->postArticle = $postArticle;

        return $this;
    }
}