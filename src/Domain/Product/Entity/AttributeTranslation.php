<?php

namespace App\Domain\Product\Entity;

use App\Domain\Core\Entity\AbstractTranslation;
use App\Domain\Core\Entity\Locale;
use App\Domain\Product\Repository\AttributeTranslationRepository;
use App\Traits\ResourceId;
use App\Traits\Timestampable;
// use Symfony\Component\Intl\Locale;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Polyfill\Uuid\Uuid;

/**
 * @ORM\Table(name="attributes_translations")
 * @ORM\Entity(repositoryClass=AttributeTranslationRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class AttributeTranslation extends AbstractTranslation
{
    use ResourceId;
    use Timestampable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\Core\Entity\Locale")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     */
    private $locale;

    /**
     * @ORM\ManyToOne(targetEntity="Attribute", inversedBy="attributeTranslations")
     * @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
     */
    private $attribute;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->uuid      = Uuid::uuid_create(Uuid::UUID_TYPE_TIME);
    }

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(Attribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }
}
