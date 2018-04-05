<?php

namespace ZF\OAuth2\Doctrine\Entity;

/**
 * PublicKey
 */
class PublicKey
{
    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string
     */
    private $encryptionAlgorithm;

    /**
     * @var bigint
     */
    private $id;

    /**
     * @var Client
     */
    private $client;

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'publicKey' => $this->getPublicKey(),
            'privateKey' => $this->getPrivateKey(),
            'encryptionAlgorithm' => $this->getEncryptionAlgorithm(),
            'client' => $this->getClient(),
        ];
    }

    /**
     * Set publicKey
     *
     * @param string $publicKey
     * @return PublicKey
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Get publicKey
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * Set privateKey
     *
     * @param string $privateKey
     * @return PublicKey
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Get privateKey
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Set encryptionAlgorithm
     *
     * @param string $encryptionAlgorithm
     * @return PublicKey
     */
    public function setEncryptionAlgorithm($encryptionAlgorithm)
    {
        $this->encryptionAlgorithm = $encryptionAlgorithm;

        return $this;
    }

    /**
     * Get encryptionAlgorithm
     *
     * @return string
     */
    public function getEncryptionAlgorithm()
    {
        return $this->encryptionAlgorithm;
    }

    /**
     * Get id
     *
     * @return bigint
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set client
     *
     * @param Client $client
     * @return PublicKey
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
