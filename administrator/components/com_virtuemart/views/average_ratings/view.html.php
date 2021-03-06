<?php

/**
 *
 * Description
 *
 * @package	VirtueMart
 * @subpackage	ratings
 * @author
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 6219 2012-07-04 16:10:42Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the view framework
if (!class_exists('VmView'))
    require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmview.php');

/**
 * HTML View class for ratings (and customer reviews)
 *
 */
class VirtuemartViewAverage_Ratings extends VmView {

//    public $max_rating;

    function display($tpl = null) {

        $mainframe = Jfactory::getApplication();
        $option = JRequest::getWord('option');




        /* Get the task */
        $task = JRequest::getWord('task');
        switch ($task) {

            case 'edit':
                $cid = JRequest::getVar('cid');

                $task = JRequest::getWord('task', 'edit');
                
                $model = VmModel::getModel();
                $averageedit = $model->getRating($cid);
                $this->assignRef('averageedit', $averageedit);
                $this->addStandardEditViewCommands();
                $this->SetViewTitle('AVERAGE_RATING_EDIT', '');

                break;
            default:
                $model = VmModel::getModel();
//                $this->addStandardDefaultViewCommands(false, false);
                $this->addStandardDefaultViewLists($model);

                $search = JRequest::getVar('filter_ratings');
                $ratings = $model->getRatings($search,false);

                $pagination = $model->getPagination();
                $this->assignRef('pagination', $pagination);
                $this->assignRef('ratings', $ratings);
                $this->SetViewTitle('AVERAGE_RATING_LIST', '');

                break;
        }
        parent::display($tpl);
    }

}

// pure php no closing tag
