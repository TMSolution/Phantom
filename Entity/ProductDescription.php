<?php

namespace PhantomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="phantom_product_description")
 */
class ProductDescription {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $descripiton;
    
    /**
     * @ORM\OneToOne(targetEntity="Product", inversedBy="productDescription")
     */
    protected $product;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shortDescription;
    

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
     * Set descripiton
     *
     * @param string $descripiton
     * @return ProductDescription
     */
    public function setDescripiton($descripiton)
    {
        $this->descripiton = $descripiton;

        return $this;
    }

    /**
     * Get descripiton
     *
     * @return string 
     */
    public function getDescripiton()
    {
        return $this->descripiton;
    }

    /**
     * Set product
     *
     * @param \PhantomBundle\Entity\Product $product
     * @return ProductDescription
     */
    public function setProduct(\PhantomBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \PhantomBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    public function __toString() {
        return $this->shortDescription;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return ProductDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }
}
