<?php

namespace Application\BlogBundle\Entity;

/**
 * @orm:Entity
 * @Table(name="post")
 */
class Post
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @orm:Column(type="string", length="255")
     * @validation:Validation({
     *      @validation:MinLength(limit=10),
     *      @validation:NotBlank(),
     *      @validation:MaxLength(limit=255)
     * })
     */
    protected $title;

    /**
     * @orm:Column(type="string", length="255")
     * @validation:Validation({
     *      @validation:MinLength(limit=10),
     *      @validation:NotBlank(),
     *      @validation:MaxLength(limit=255)
     * })
     */
    protected $slug;

    /**
     * @orm:Column(type="text")
     */
    protected $intro;

    /**
     * @orm:Column(type="text")
     * @validation:Validation({
     *      @validation:NotBlank()
     * })
     */
    protected $body;

    public function getBody()
    {
      return $this->body;
    }

    public function getId()
    {
      return $this->id;
    }

    public function getIntro()
    {
      return $this->intro;
    }

    public function getSlug()
    {
      return $this->slug;
    }

    public function getTitle()
    {
      return $this->title;
    }

    public function setBody($body)
    {
      $this->body = $body;
    }

    public function setIntro($intro)
    {
      $this->intro = $intro;
    }

    public function setSlug($slug)
    {
      $this->slug = $slug;
    }

    public function setTitle($title)
    {
      $this->title = $title;
    }
}
