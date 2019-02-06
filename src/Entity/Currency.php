<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
 */
class Currency
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Source")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rate;

    function __construct(Source $source, string $name, string $rate)
    {
        $this->source = $source;
        $this->name = $name;
        $this->rate = $rate;


    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource(): ?source
    {
        return $this->source;
    }

    public function setSource(?source $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function toArray():array
    {
        return ['name' => $this->name, 'rate' => $this->rate];
    }

}
