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
 * GridConifg  for 'PhantomBundle\Entity\ProductCategory'.
 *
 * Generated with {@see TMSolution\GridBundle\Command\GridConfigCommand}.
 */
class ProductCategory extends GridBuilder
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
       $queryBuilder->select($tableAlias.'.id,'.$tableAlias.'.name,'.'_parent.name as parent::name');

       $queryBuilder->leftJoin("$tableAlias.parent","_parent");
       
       //dump($queryBuilder->getDQL()); //if you want to know how dql looks
       //dump($queryBuilder->getQuery()->getSQL()); //if you want to know how dql looks  
      };
      $grid->getSource()->manipulateQuery($queryBuilderFn);
    }

    protected function configureColumn($grid)
    {
     
                            
      $column = new TextColumn(array('id' => 'parent.name', 'field'=>'parent.name' ,'title' => 'parent.name', 'source' => $grid->getSource(), 'filterable' => true, 'sortable' => true));
      $column->setFilterType('select');
      $column->setSelectExpanded(TRUE);//TRUE - RADIO or CHECKBOXES, FALSE - SELECT
      $column->setSelectMulti(TRUE);//FALSE - RADIO or TRUE - CHECKBOXES 
      $grid->addColumn($column,$columnOrder=null);
               
      $grid->setDefaultOrder('id', 'asc');
      $grid->setVisibleColumns(['id','name','parent.name']);
      $grid->setColumnsOrder(['id','name','parent.name']);

    /** field id configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
      $column = $grid->getColumn('id'); 
      $column->setTitle('ProductCategory.id');    
      $column->manipulateRenderCell(function($value, $row) {
       //return strip_tags($value); //use this function when setSafe is false
       return $value;
      });
   
    */
    /** field name configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
      $column = $grid->getColumn('name'); 
      $column->setTitle('ProductCategory.name');    
      $column->manipulateRenderCell(function($value, $row) {
       //return strip_tags($value); //use this function when setSafe is false
       return $value;
      });
   
    */
    /** field parent configuration */    
    
    /*
      //$column->setSafe(false); // not convert html entities
    $column = $grid->getColumn('parent.name'); 
      $column->setTitle('ProductCategory.parent.name');    
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
          $grid->setShowFilters(['id','name','parent']);
          
    }

    protected function configureExport($grid)
    {
           
          $grid->addExport(new ExcelExport('Excel'));
          $grid->addExport(new CSVExport('CSV'));
          $grid->addExport(new XMLExport('XML'));
          
    }

    protected function configureRowButton($grid,$routePrefix)
    {

        $rowAction = new RowAction('glyphicon glyphicon-eye-open', $routePrefix.'_read', false, null, ['id'=>'productcategory-show', 'data-load-target' => 'test-div', 'class' => 'lazy', 'data-original-title' => 'Show']);
        $rowAction->setRouteParameters(['entityName' => 'productcategory','id']);
        $grid->addRowAction($rowAction);
    
        $rowAction = new RowAction('glyphicon glyphicon-edit', $routePrefix.'_update', false, null, ['id'=>'productcategory-edit', 'data-load-target' => 'test-div', 'class' => 'lazy', 'data-original-title' => 'Edit']);
        $rowAction->setRouteParameters(['entityName' => 'productcategory','id']);
        $grid->addRowAction($rowAction);
        
        $rowAction = new RowAction('glyphicon glyphicon-remove', $routePrefix.'_delete', false, null, ['id'=>'productcategory-delete', 'data-load-target' => 'test-div', 'class' => 'lazy', 'data-original-title' => 'Delete']);
        $rowAction->setRouteParameters(['entityName' => 'productcategory','id']);
        $grid->addRowAction($rowAction);
    }

}

