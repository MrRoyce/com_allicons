<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * AllIconss View
 */
class AllIconsViewAllIcons extends JView
{

	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * AllIconss view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
				
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		
		// Set the toolbar
		$this->addToolBar();
 
		// Display the template
		parent::display($tpl);
		
		// Set the document
		$this->setDocument();
	}
	
	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		$canDo = AllIconsHelper::getActions();
		
		JToolBarHelper::title(JText::_('COM_ALLICONS_ALLICONS_MANAGER'), 'allicons');
		
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNewX('allicon.add');
		}
		
		if ($canDo->get('core.edit')){
			JToolBarHelper::editListX('allicon.edit');
		}
		
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteListX('', 'allicons.delete');
		}
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_allicons');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_ALLICONS_ADMINISTRATION'));
	}
}