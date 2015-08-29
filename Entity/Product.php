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
     * @ORM\ManyToMany(targetEntity="ProductCategory", inversedBy="product")
     * @ORM\JoinTable(name="phantom_pruduct_has_category")
     */
    protected $productCategories;

    /**
     * @ORM\ManyToOne(targetEntity="ProductCategory")
     * @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     */
    protected $mainProductCategory;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductProperty", mappedBy="product")
     */
    protected $productProperties;
    
    
    public function __construct() {
        
        $this->productCategories= new ArrayCollection;
        $this->productProperties= new ArrayCollection;
        
    }
    
    public function __toString() {
        return $this->name;
    }
    
    
    
    

}
