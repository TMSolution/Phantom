<?php

namespace PhantomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="phantom_product_category")
 */
class ProductCategory {

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
     * @ORM\ManyToOne(targetEntity="ProductCategory")
     * @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="productCategories")
     */
    protected $products;

    public function __construct() {

        $this->products = new ArrayCollection;
    }

   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ProductCategory
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set parent
     *
     * @param \PhantomBundle\Entity\ProductCategory $parent
     * @return ProductCategory
     */
    public function setParent(\PhantomBundle\Entity\ProductCategory $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \PhantomBundle\Entity\ProductCategory 
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Add products
     *
     * @param \PhantomBundle\Entity\Product $product
     * @return ProductCategory
     */
    public function addProduct(\PhantomBundle\Entity\Product $product) {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \PhantomBundle\Entity\Product $product
     */
    public function removeProduct(\PhantomBundle\Entity\Product $product) {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts() {
        return $this->products;
    }

    public function __toString() {
        return $this->name;
    }

}
