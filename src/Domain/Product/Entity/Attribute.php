<?php

namespace App\Domain\Product\Entity;

use App\Domain\Product\Repository\AttributeRepository;
use App\Traits\ResourceId;
use App\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Polyfill\Uuid\Uuid;

/**
 * @ORM\Table(name="attributes")
 * @ORM\Entity(repositoryClass=AttributeRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Attribute
{
    use ResourceId;
    use Timestampable;

    const CODE_COLOR       = 'attr_color';
    const CODE_DEPTH       = 'attr_depth';
    const CODE_DESCRIPTION = 'attr_description';
    const CODE_EAN         = 'attr_ean';
    const CODE_HEIGHT      = 'attr_height';
    const CODE_MADE_IN     = 'attr_made_in';
    const CODE_MATERIAL    = 'attr_material';
    const CODE_MEDIA       = 'attr_media';
    const CODE_NAME        = 'attr_name';
    const CODE_REFERENCE   = 'attr_reference';
    const CODE_STYLE       = 'attr_style';
    const CODE_TYPE        = 'attr_type';
    const CODE_WEIGHT      = 'attr_weight';
    const CODE_WIDTH       = 'attr_width';


    // const CODE_ARCHIVED                  = 'attr_archived';
    // const CODE_BATTERY_TYPE              = 'attr_battery_type';
    // const CODE_BURNING_TIME              = 'attr_burning_time';
    // const CODE_CASH_LABEL                = 'attr_cash_label';
    // const CODE_COMPONENTS                = 'attr_components';
    // const CODE_DISHWASHER                = 'attr_dishwasher';
    // const CODE_FRAGRANT                  = 'attr_fragrant';
    // const CODE_HANGING                   = 'attr_hanging';
    // const CODE_INDUCTION_HOB             = 'attr_induction_hob';
    // const CODE_IS_AHEAD                  = 'attr_is_ahead';
    // const CODE_IS_AHEAD_IMAGE            = 'attr_is_ahead_image';
    // const CODE_IS_ALIMENTARY             = 'attr_is_alimentary';
    // const CODE_IS_CONVERTIBLE            = 'attr_is_convertible';
    // const CODE_IS_ELECTRIC               = 'attr_is_electric';
    // const CODE_IS_OUTDOOR_INDOOR         = 'attr_is_outdoor_indoor';
    // const CODE_IS_SUPPOSED_BEST          = 'attr_is_supposed_best';
    // const CODE_IS_TO_PUT                 = 'attr_is_to_put';
    // const CODE_LAMPSHADE                 = 'attr_lampshade';
    // const CODE_LEAVES_GAMMAGE            = 'attr_leaves_weight';
    // const CODE_LICENCE                   = 'attr_licence';
    // const CODE_LINE_PER_PAGE             = 'attr_line_per_page';
    // const CODE_MAX_POWER                 = 'attr_max_power';
    // const CODE_MICROWAVE                 = 'attr_microwave';
    // const CODE_MODEL                     = 'attr_model';
    // const CODE_MODULAR                   = 'attr_modular';
    // const CODE_NB_DOORS                  = 'attr_nb_doors';
    // const CODE_NB_PACKAGES               = 'attr_nb_packages';
    // const CODE_NB_SEATS                  = 'attr_nb_seats';
    // const CODE_NUMBER_BATTERY            = 'attr_number_battery';
    // const CODE_NUMBER_BULBS              = 'attr_number_bulbs';
    // const CODE_ORIGIN                    = 'attr_origin';
    // const CODE_OVEN                      = 'attr_oven';
    // const CODE_PACKAGE_RECYCLABLE        = 'attr_package_recyclable';
    // const CODE_PAGE_NUMBER               = 'attr_page_number';
    // const CODE_PARFUMED                  = 'attr_parfumed';
    // const CODE_PRODUCT_CAPACITY          = 'attr_product_capacity';
    // const CODE_PRODUCT_RANGE             = 'attr_product_range';
    // const CODE_PROVIDED_BATTERY          = 'attr_provided_battery';
    // const CODE_PROVIDED_BULBS            = 'attr_provided_bulbs';
    // const CODE_PROVIDERS                 = 'attr_providers';
    // const CODE_PURCHASE_GROUP            = 'attr_purchase_group';
    // const CODE_PURCHASE_GROUP_FULL_VALUE = 'attr_purchase_group_full_value';
    // const CODE_PURCHASE_SUB_SUBGROUP     = 'attr_purchase_sub_subgroup';
    // const CODE_PURCHASE_SUBGROUP         = 'attr_purchase_subgroup';
    // const CODE_REPLACEABLE_BULBS         = 'attr_replaceable_bulbs';
    // const CODE_SCENT                     = 'attr_scent';
    // const CODE_SCIENTIFIC_NAME           = 'attr_scientific_name';
    // const CODE_SECURITY_MARKING          = 'attr_security_marking';
    // const CODE_SEO_ALT_MAIN_IMAGE        = 'attr_seo_alt_main_image';
    // const CODE_SEO_META_DESCRIPTION      = 'attr_seo_meta_description';
    // const CODE_SEO_TITLE                 = 'attr_seo_title';
    // const CODE_SOCKET                    = 'attr_socket';
    // const CODE_TECHNICAL_DESCRIPTION     = 'attr_technical_description';
    // const CODE_TEXTILE_MARKING           = 'attr_textile_marking';
    // const CODE_TEXTILES_COMPOSITION      = 'attr_textiles_composition';
    // const CODE_TYPE_BULBS                = 'attr_type_bulbs';
    // const CODE_WASHING_INSTRUCTIONS      = 'attr_washing_instructions';
    // const CODE_WOOD_COUNTRY_ORIGIN       = 'attr_wood_country_origin';
    // const CODE_WOOD_ESSENCE              = 'attr_wood_essence';
    // const CODE_TECHNICAL_DATA_SHEET      = 'attr_technical_data_sheet';

    /**
     * @Assert\Unique
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="AttributeTranslation", mappedBy="attribute", cascade={"persist", "remove"})
     */
    private $attributeTranslations;

    public function __construct()
    {
        $this->attributeTranslations = new ArrayCollection();
        $this->createdAt             = new \DateTimeImmutable();
        $this->uuid                  = Uuid::uuid_create(Uuid::UUID_TYPE_TIME);
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

    public function getAttributeTranslations(): Collection
    {
        return $this->attributeTranslations;
    }

    public function addAttributeTranslation(AttributeTranslation $attributeTranslation): self
    {
        if (!$this->attributeTranslations->contains($attributeTranslation)) {
            $this->attributeTranslations[] = $attributeTranslation;
            $attributeTranslation->setAttribute($this);
        }

        return $this;
    }

    public function removeAttributeTranslation(AttributeTranslation $attributeTranslation): self
    {
        if ($this->attributeTranslations->contains($attributeTranslation)) {
            $this->attributeTranslations->removeElement($attributeTranslation);
        }

        return $this;
    }
}
