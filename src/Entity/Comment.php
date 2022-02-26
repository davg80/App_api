<?php

namespace App\Entity;

/**
 * Class Comment
 * @package App\Entity
 *  
 */
class Comment{

    /**
     *
     * @var integer|null
     */
    private ?int $id;
    /**
     *
     * @var string
     */
    private string $content;
    /**
     *
     * @var \DateTimeInterface
     */
    private \DateTimeInterface $date_comment;

    /**
     *
     * @var User
     */
    private User $author;

    /**
     * @param \DateTimeImmutable $publishedAt
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
     * 
     * @var PostArticles
     */
    private PostArticles $post_article;

    /**
     * Get the value of post_article
     *
     * @return  PostArticles
     */ 
    public function getPost_article()
    {
        return $this->post_article;
    }

    /**
     * Set the value of post_article
     *
     * @param  PostArticles  $post_article
     *
     * @return  self
     */ 
    public function setPost_article(PostArticles $post_article)
    {
        $this->post_article = $post_article;

        return $this;
    }
}