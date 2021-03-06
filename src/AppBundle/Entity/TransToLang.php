<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * TransToLang
 *
 * @ORM\Table(name="translation_to_lang")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransToLangRepository")
 * @Serializer\ExclusionPolicy("All")
 */
class TransToLang
{

    /**
     * @var string
     *
     * @ORM\Column(name="trans", type="string", length=255, nullable=true)
     * @Serializer\Expose
     */
    private $trans;

    /**
     * @var \AppBundle\Entity\Lang
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Lang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lang_id", referencedColumnName="code")
     * })
     */
    private $lang;
    /**
     *
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Translation", inversedBy="lang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="translation_id", referencedColumnName="id")
     * })
     */
    private $translation;


    /**
     * Set trans
     *
     * @param string $trans
     *
     * @return TransToLang
     */
    public function setTrans($trans)
    {
        $this->trans = $trans;

        return $this;
    }

    /**
     * Get trans
     *
     * @return string
     */
    public function getTrans()
    {
        return $this->trans;
    }

    /**
     * Set lang
     *
     * @param \AppBundle\Entity\Lang $lang
     *
     * @return TransToLang
     */
    public function setLang(\AppBundle\Entity\Lang $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return \AppBundle\Entity\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set translation
     *
     * @param \AppBundle\Entity\Translation $translation
     *
     * @return TransToLang
     */
    public function setTranslation(\AppBundle\Entity\Translation $translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return \AppBundle\Entity\Translation
     */
    public function getTranslation()
    {
        return $this->translation;
    }
}
