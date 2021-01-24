<?php

namespace BackendBundle\Entity;

/**
 * Like
 */
class Like
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \BackendBundle\Entity\Publication
     */
    private $publication;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $user;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set publication.
     *
     * @param \BackendBundle\Entity\Publication|null $publication
     *
     * @return Like
     */
    public function setPublication(\BackendBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication.
     *
     * @return \BackendBundle\Entity\Publication|null
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set user.
     *
     * @param \BackendBundle\Entity\User|null $user
     *
     * @return Like
     */
    public function setUser(\BackendBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \BackendBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
