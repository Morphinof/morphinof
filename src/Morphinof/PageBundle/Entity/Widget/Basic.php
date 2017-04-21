<?php

namespace Morphinof\PageBundle\Entity\Widget;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

use Morphinof\PageBundle\Traits\CreatedUpdatedTrait;
use Morphinof\PageBundle\Traits\SlugTrait;
use Morphinof\PageBundle\Traits\TwigTrait;

use Morphinof\PageBundle\Entity\Widget;

/**
 * Basic widget
 *
 * @ORM\Entity()
 */
class Basic extends Widget
{
    use CreatedUpdatedTrait;
    use SlugTrait;
    use TwigTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

