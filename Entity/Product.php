<?php

namespace PhantomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="phantom_product")
 */
class Product {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;
    
    /**
     * @ORM\OneToOne(targetEntity="ProductDescription", inversedBy="product")
     */
    protected $productDescription;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductProperty", mappedBy="product")
     */
    protected $productProperties;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductCategory")
     * @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     */
    protected $mainProductCategory;
    
    /**
     * @ORM\ManyToMany(targetEntity="ProductCategory", inversedBy="product")
     * @ORM\JoinTable(name="phantom_pruduct_has_category")
     */
    protected $productCategories;

    
    
    public function __construct() {
        
        $this->productCategories= new ArrayCollection;
        $this->productProperties= new ArrayCollection;
        
    }
    
    public function __toString() {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Product
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
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set productDescription
     *
     * @param \PhantomBundle\Entity\ProductDescription $productDescription
     * @return Product
     */
    public function setProductDescription(\PhantomBundle\Entity\ProductDescription $productDescription = null)
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    /**
     * Get productDescription
     *
     * @return \PhantomBundle\Entity\ProductDescription 
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * Add productProperties
     *
     * @param \PhantomBundle\Entity\ProductProperty $productProperty
     * @return Product
     */
    public function addProductProperty(\PhantomBundle\Entity\ProductProperty $productProperty)
    {
        $this->productProperties[] = $productProperty;

        return $this;
    }

    /**
     * Remove productProperties
     *
     * @param \PhantomBundle\Entity\ProductProperty $productProperty
     */
    public function removeProductProperty(\PhantomBundle\Entity\ProductProperty $productProperty)
    {
        $this->productProperties->removeElement($productProperty);
    }

    /**
     * Get productProperties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductProperties()
    {
        return $this->productProperties;
    }

    /**
     * Set mainProductCategory
     *
     * @param \PhantomBundle\Entity\ProductCategory $mainProductCategory
     * @return Product
     */
    public function setMainProductCategory(\PhantomBundle\Entity\ProductCategory $mainProductCategory = null)
    {
        $this->mainProductCategory = $mainProductCategory;

        return $this;
    }

    /**
     * Get mainProductCategory
     *
     * @return \PhantomBundle\Entity\ProductCategory 
     */
    public function getMainProductCategory()
    {
        return $this->mainProductCategory;
    }

    /**
     * Add productCategories
     *
     * @param \PhantomBundle\Entity\ProductCategory $productCategory
     * @return Product
     */
    public function addProductCategory(\PhantomBundle\Entity\ProductCategory $productCategory)
    {
        $this->productCategories[] = $productCategory;

        return $this;
    }

    /**
     * Remove productCategories
     *
     * @param \PhantomBundle\Entity\ProductCategory $productCategory
     */
    public function removeProductCategory(\PhantomBundle\Entity\ProductCategory $productCategory)
    {
        $this->productCategories->removeElement($productCategory);
    }

    /**
     * Get productCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductCategories()
    {
        return $this->productCategories;
    }
}
