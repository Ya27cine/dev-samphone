<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


class ProduitSearch
{
    /**
     *@var int|null
     *@Assert\Range(min=0, max=2000)
     */
    private $maxPrix;

    /**
     *@var ArrayCollection
     */
    private $options;

    /**
     * @var int|null

     */
    private $minQuantitie;



    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrix(): ?int
    {
        return $this->maxPrix;
    }

    /**
     * @param int|null $maxPrix
     */
    public function setMaxPrix(int $maxPrix): void
    {
        $this->maxPrix = $maxPrix;
    }

    /**
     * @return int|null
     */
    public function getMinQuantitie(): ?int
    {
        return $this->minQuantitie;
    }

    /**
     * @param int|null $minQuantitie
     */
    public function setMinQuantitie(int $minQuantitie): void
    {
        $this->minQuantitie = $minQuantitie;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }


}
