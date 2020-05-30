<?php

namespace App\Domain\Product\Entity;

use App\Domain\Product\Repository\ProductRepository;
use App\Traits\ResourceId;
use App\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Polyfill\Uuid\Uuid;

/**
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="ProductRepository::class")
 * @ORM\HasLifecycleCallbacks
 */
class Product
{
    use ResourceId;
    use Timestampable;

    const TAX_RULE_STANDARD = 20;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\Unique
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $priceEt;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $priceIt;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=3)
     */
    private $taxRule;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->enabled = true;
        $this->uuid = Uuid::uuid_create(Uuid::UUID_TYPE_TIME);
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceEt(): ?string
    {
        return $this->priceEt;
    }

    public function setPriceEt(string $priceEt): self
    {
        $this->priceEt = $priceEt;

        return $this;
    }

    public function getPriceIt(): ?string
    {
        return $this->priceIt;
    }

    public function setPriceIt(string $priceIt): self
    {
        $this->priceIt = $priceIt;

        return $this;
    }

    public function getTaxRule(): ?string
    {
        return $this->taxRule;
    }

    public function setTaxRule(string $taxRule): self
    {
        $this->taxRule = $taxRule;

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
