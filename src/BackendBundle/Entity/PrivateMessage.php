<?php

namespace BackendBundle\Entity;

/**
 * PrivateMessage
 */
class PrivateMessage
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var string|null
     */
    private $file;

    /**
     * @var string|null
     */
    private $image;

    /**
     * @var string|null
     */
    private $readed;

    /**
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $emitter;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $receiver;


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
     * Set message.
     *
     * @param string|null $message
     *
     * @return PrivateMessage
     */
    public function setMessage($message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set file.
     *
     * @param string|null $file
     *
     * @return PrivateMessage
     */
    public function setFile($file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return string|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set image.
     *
     * @param string|null $image
     *
     * @return PrivateMessage
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set readed.
     *
     * @param string|null $readed
     *
     * @return PrivateMessage
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
     * @return PrivateMessage
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
     * Set emitter.
     *
     * @param \BackendBundle\Entity\User|null $emitter
     *
     * @return PrivateMessage
     */
    public function setEmitter(\BackendBundle\Entity\User $emitter = null)
    {
        $this->emitter = $emitter;

        return $this;
    }

    /**
     * Get emitter.
     *
     * @return \BackendBundle\Entity\User|null
     */
    public function getEmitter()
    {
        return $this->emitter;
    }

    /**
     * Set receiver.
     *
     * @param \BackendBundle\Entity\User|null $receiver
     *
     * @return PrivateMessage
     */
    public function setReceiver(\BackendBundle\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver.
     *
     * @return \BackendBundle\Entity\User|null
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}
