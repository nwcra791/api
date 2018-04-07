<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Domain
 *
 * @ORM\Table(name="domain", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_A7A91E0B989D9B62", columns={"slug"})}, indexes={@ORM\Index(name="IDX_A7A91E0BA76ED395", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DomainRepository")
 *
 */
class Domain
{
    /**
     * @Serializer\Groups({"showOne"})
     * @Serializer\SerializedName("langs");
     */

    protected $languages = array();

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"show", "showOne"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     * @Serializer\Groups({"show", "showOne"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Serializer\Groups({"show", "showOne"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *@Serializer\Groups({"show", "showOne"})
     */
    private $description;


    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     * @Serializer\Groups({"showOne"})
     * @Serializer\SerializedName("creator");
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Serializer\Groups({"showOne"})
     */
    private $createdAt;



    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Lang", inversedBy="domain")
     * @ORM\JoinTable(name="domain_lang",
     *   joinColumns={
     *     @ORM\JoinColumn(name="domain_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="lang_id", referencedColumnName="code")
     *   }
     * )
     *
     */
    private $lang;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lang = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reformatLang();
        $this->createdAt = new \Datetime();
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Domain
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Domain
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Domain
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Domain
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Domain
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add lang
     *
     * @param \AppBundle\Entity\Lang $lang
     *
     * @return Domain
     */
    public function addLang(\AppBundle\Entity\Lang $lang)
    {
        $this->lang[] = $lang;
        $lang->addDomain($this);

        return $this;
    }

    /**
     * Remove lang
     *
     * @param \AppBundle\Entity\Lang $lang
     */
    public function removeLang(\AppBundle\Entity\Lang $lang)
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

    public function reformatLang()
    {
        $langs = array();
        foreach($this->lang as $lang) {
            array_push($langs, $lang->getCode());
        }
        $this->languages = $langs;
    }

}
