<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Translation
 *
 * @ORM\Table(name="translation", uniqueConstraints={@ORM\UniqueConstraint(name="domain_id", columns={"domain_id", "code"})}, indexes={@ORM\Index(name="IDX_B469456F115F0EE5", columns={"domain_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TranslationRepository")
 *
 */
class Translation
{
    /**
     * @Serializer\Groups({"showDomainTranslations"})
     * @Serializer\SerializedName("trans")
     */
    private $tabLangs = array();

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"showDomainTranslations"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     * @Serializer\Groups({"showOne", "showDomainTranslations"})
     */
    private $code;

    /**
     * @var \AppBundle\Entity\Domain
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Domain")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="domain_id", referencedColumnName="id")
     * })
     *
     */
    private $domain;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TransToLang", mappedBy="translation", cascade={"remove"})
     */
    private $lang;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lang = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setTabLangs($name)
    {
        $this->tabLangs = $name;

        return $this;
    }

    public function getTabLangs()
    {
        return $this->tabLangs;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Translation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set domain
     *
     * @param \AppBundle\Entity\Domain $domain
     *
     * @return Translation
     */
    public function setDomain(\AppBundle\Entity\Domain $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return \AppBundle\Entity\Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }


    /**
     * Add lang
     *
     * @param \AppBundle\Entity\TransToLang $lang
     *
     * @return Translation
     */
    public function addLang(\AppBundle\Entity\TransToLang $lang)
    {
        $this->lang[] = $lang;
        $lang->setTranslation($this);
        return $this;
    }

    /**
     * Remove lang
     *
     * @param \AppBundle\Entity\TransToLang $lang
     */
    public function removeLang(\AppBundle\Entity\TransToLang $lang)
    {
        $this->lang->removeElement($lang);
    }

    /**
     * Get lang
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLang()
    {
        return $this->lang;
    }
}
