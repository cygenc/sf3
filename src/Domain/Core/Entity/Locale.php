<?php

namespace App\Domain\Core\Entity;

use App\Domain\Core\Repository\LocaleRepository;
use App\Traits\ResourceId;
use App\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Polyfill\Uuid\Uuid;

/**
 * @ORM\Table(name="locales")
 * @ORM\Entity(repositoryClass=LocaleRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Locale
{
    use ResourceId;
    use Timestampable;

    const CODE_FR = 'fr';
    const CODE_EN = 'en';

    const NAME_FR = 'Français';
    const NAME_EN = 'English';

    /**
     * @Assert\Locale(
     *     canonicalize = true
     * )
     * @Assert\Unique
     * @ORM\Column(type="string", length=50)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->uuid = Uuid::uuid_create(Uuid::UUID_TYPE_TIME);
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getDefault(): string
    {
        return self::CODE_FR;
    }

    public function isDefault(): bool
    {
        return self::CODE_FR === $this->code;
    }
}
