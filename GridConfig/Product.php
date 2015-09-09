<?php 
/**
 * Copyright (c) 2014, TMSolution
 * All rights reserved.
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */
namespace  PhantomBundle\GridConfig;

use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Export\CSVExport;
use APY\DataGridBundle\Grid\Export\XMLExport;
use TMSolution\DataGridBundle\Grid\Column\NumberColumn;
use TMSolution\DataGridBundle\Grid\Column\TextColumn;
use TMSolution\DataGridBundle\Grid\Action\RowAction;
use TMSolution\DataGridBundle\GridBuilder\GridBuilder;

/**
 * GridConifg  for 'PhantomBundle\Entity\Product'.
 *
 * Generated with {@see TMSolution\GridBundle\Command\GridConfigCommand}.
 */
class Product extends GridBuilder
{

    public function buildGrid($grid,$routePrefix)
    {
        
        $this->manipulateQuery($grid);
        $this->configureColumn($grid);
        $this->configureFilter($grid);
        $this->configureExport($grid);
        $this->configureRowButton($grid,$routePrefix);
        
        return $grid;
    }
    
   protected function manipulateQuery($grid)
    {
      $tableAlias = $grid->getSource()->getTableAlias();
      $queryBuilderFn = function ($queryBuilder) use($tableAlias) {
      
      //Create virtual or aggregate column (contact(a,b), max(a) etc.) always with alias.
      //Example:
      //concat(' . $tableAlias . '.name,' . $tableAlias . '.id) as alias
      //in function addColumn set parameters: 'isManualField'=>true,'field' => 'alias'
      
       $queryBuilder->resetDQLPart('select');
       $queryBuilder->resetDQLPart('join');
       $queryBuilder->select($tableAlias.'.id,'.$tableAlias.'.name,'.$tableAlias.'.price,'.'_productDescription.id as productDescription::id,'.'_mainProductCategory.name as mainProductCategory::name');

       $queryBuilder->leftJoin("$tableAlias.productDescription","_productDescription");
       $queryBuilder->leftJoin("$tableAlias.mainProductCategory","_mainProductCategory");
       
       //dump($queryBuilder->getDQL()); //if you want to know how dql looks
       //dump($queryBuilder->getQuery()->getSQL()); //if you want to know how dql looks  
      };
      $grid->getSource()->manipulateQuery($queryBuilderFn);
    }

    protected function configureColumn($grid)
    {
     
                                 
      $column = new NumberColumn(array('id' => 'productDescription.id', 'field'=>'productDescription.id' ,'title' => 'productDescription.id', 'source' => $grid->getSource(), 'filterable' => true, 'sortable' => true));
      $column->setFilterType('select');
      $column->setSelectExpanded(FALSE);//TRUE - RADIO or CHECKBOXES, FALSE - SELECT
      //$column->setSelectMulti(FALSE);//FALSE - RADIO or TRUE - CHECKBOXES 
      $grid->addColumn($column,$columnOrder=null);
                        
      $column = new TextColumn(array('id' => 'mainProductCategory.name', 'field'=>'mainProductCategory.name' ,'title' => 'mainProductCategory.name', 'source' => $grid->getSource(), 'filterable' => true, 'sortable' => true));
      $column->setFilterType('select');
      $column->setSelectExpanded(FALSE);//TRUE - RADIO or CHECKBOXES, FALSE - SELECT
      //$column->setSelectMulti(FALSE);//FALSE - RADIO or TRUE - CHECKBOXES 
      $grid->addColumn($column,$columnOrder=null);
               
      $grid->setDefaultOrder('id', 'asc');
      $grid->setVisibleColumns(['id','name','price','productDescription.id','mainProductCategory.name']);
      $grid->setColumnsOrder(['id','name','price','productDescription.id','mainProductCategory.name']);

    /** field id configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
      $column = $grid->getColumn('id'); 
      $column->setTitle('Product.id');    
      $column->manipulateRenderCell(function($value, $row) {
       //return strip_tags($value); //use this function when setSafe is false
       return $value;
      });
   
    */
    /** field name configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
      $column = $grid->getColumn('name'); 
      $column->setTitle('Product.name');    
      $column->manipulateRenderCell(function($value, $row) {
       //return strip_tags($value); //use this function when setSafe is false
       return $value;
      });
   
    */
    /** field price configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
      $column = $grid->getColumn('price'); 
      $column->setTitle('Product.price');    
      $column->manipulateRenderCell(function($value, $row) {
       //return strip_tags($value); //use this function when setSafe is false
       return $value;
      });
   
    */
    /** field productDescription configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
    $column = $grid->getColumn('productDescription.id'); 
      $column->setTitle('Product.productDescription.id');    
      $column->manipulateRenderCell(function($value, $row) {
       //return strip_tags($value); //use this function when setSafe is false
       return $value;
      });
   
    */
    /** field mainProductCategory configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
    $column = $grid->getColumn('mainProductCategory.name'); 
      $column->setTitle('Product.mainProductCategory.name');    
      $column->manipulateRenderCell(function($value, $row) {
       //return strip_tags($value); //use this function when setSafe is false
       return $value;
      });
   
    */
      
    }

    protected function configureFilter($grid)
    {
    
          /* hide filters */
          //$grid->hideFilters();
          
          /* filter columns [blocks]*/      
          $grid->setNumberPresentedFilterColumn(3);
          $grid->setShowFilters(['id','name','price','productDescription','mainProductCategory']);
          
    }

    protected function configureExport($grid)
    {
           
          $grid->addExport(new ExcelExport('Excel'));
          $grid->addExport(new CSVExport('CSV'));
          $grid->addExport(new XMLExport('XML'));
          
    }

    protected function configureRowButton($grid,$routePrefix)
    {

        $rowAction = new RowAction('glyphicon glyphicon-eye-open', $routePrefix.'_read', false, null, ['id' => 'product-show', 'class' => 'lazy button-class', 'data-original-title' => 'Show']);
        $rowAction->setRouteParameters(['entityName' => 'product','id']);
        $grid->addRowAction($rowAction);
    
        $rowAction = new RowAction('glyphicon glyphicon-edit', $routePrefix.'_update', false, null, ['id' => 'product-edit', 'class' => 'lazy button-class', 'data-original-title' => 'Edit']);
        $rowAction->setRouteParameters(['entityName' => 'product','id']);
        $grid->addRowAction($rowAction);
        
        $rowAction = new RowAction('glyphicon glyphicon-remove', $routePrefix.'_delete', false, null, ['id' => 'product-delete', 'class' => 'lazy button-class', 'data-original-title' => 'Delete']);
        $rowAction->setRouteParameters(['entityName' => 'product','id']);
        $grid->addRowAction($rowAction);
    }

}

