<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Lang
 *
 * @ORM\Table(name="lang")
 * @ORM\Entity
 *
 */

class Lang
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=5)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"showOne","showLang"})
     */
    private $code;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Domain", mappedBy="lang")
     */
    private $domain;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->domain = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add domain
     *
     * @param \AppBundle\Entity\Domain $domain
     *
     * @return Lang
     */
    public function addDomain(\AppBundle\Entity\Domain $domain)
    {
        $this->domain[] = $domain;

        return $this;
    }

    /**
     * Remove domain
     *
     * @param \AppBundle\Entity\Domain $domain
     */
    public function removeDomain(\AppBundle\Entity\Domain $domain)
    {
        $this->domain->removeElement($domain);
    }

    /**
     * Get domain
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomain()
    {
        return $this->domain;
    }

}
