<?php

namespace BackendBundle\Entity;

/**
 * Notification
 */
class Notification
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var int|null
     */
    private $typeId;

    /**
     * @var string|null
     */
    private $readed;

    /**
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @var string|null
     */
    private $extra;

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
     * Set type.
     *
     * @param string|null $type
     *
     * @return Notification
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set typeId.
     *
     * @param int|null $typeId
     *
     * @return Notification
     */
    public function setTypeId($typeId = null)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId.
     *
     * @return int|null
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set readed.
     *
     * @param string|null $readed
     *
     * @return Notification
     */
    public function setReaded($readed = null)
    {
        $this->readed = $readed;

        return $this;
    }

    /**
     * Get readed.
     *
     * @return string|null
     */
    public function getReaded()
    {
        return $this->readed;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Notification
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set extra.
     *
     * @param string|null $extra
     *
     * @return Notification
     */
    public function setExtra($extra = null)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get extra.
     *
     * @return string|null
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set user.
     *
     * @param \BackendBundle\Entity\User|null $user
     *
     * @return Notification
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
