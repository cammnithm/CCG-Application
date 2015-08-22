<?php
/**
 * @version     1.0.0
 * @package     com_ccgslider
 * @copyright   Copyright (C) 2015. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Timma <dieudonnetimma@yahoo.fr> - http://www.camgiess.de
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');
jimport('joomla.filesystem.folder');
/**
 * Ccgslider model.
 */
class CcgsliderModelSlider extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_CCGSLIDER';


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Slider', $prefix = 'CcgsliderTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_ccgslider.slider', 'slider', array('control' => 'jform', 'load_data' => $loadData));
        
        
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_ccgslider.edit.slider.data', array());

		if (empty($data)) {
			$data = $this->getItem();
            
		}

		return $data;
	}
    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
    public function save($data)
    {
        $dispatcher = JEventDispatcher::getInstance();
        $table = $this->getTable();

        if ((!empty($data['tags']) && $data['tags'][0] != ''))
        {
            $table->newTags = $data['tags'];
        }

        $key = $table->getKeyName();
        $pk = (!empty($data[$key])) ? $data[$key] : (int) $this->getState($this->getName() . '.id');
        $isNew = true;

        // Include the content plugins for the on save events.
        JPluginHelper::importPlugin('content');

        // Allow an exception to be thrown.
        try
        {
            // Load the row if saving an existing record.
            if ($pk > 0)
            {
                $table->load($pk);
                $isNew = false;
            }

            // Bind the data.
            if (!$table->bind($data))
            {
                $this->setError($table->getError());

                return false;
            }

            // Prepare the row for saving
            $this->prepareTable($table);

            // Check the data.
            if (!$table->check())
            {
                $this->setError($table->getError());
                return false;
            }

            // Trigger the onContentBeforeSave event.
            $result = $dispatcher->trigger($this->event_before_save, array($this->option . '.' . $this->name, $table, $isNew));

            if (in_array(false, $result, true))
            {
                $this->setError($table->getError());
                return false;
            }

            // Store the data.
            if (!$table->store())
            {
                $this->setError($table->getError());
                return false;
            }

            //todo put the methode to save the file
            $id = $data['id'];
            $folder = $data['file'];
           if( !$this->saveTheFile($id, $folder))
               return false;
            // Clean the cache.
            $this->cleanCache();

            // Trigger the onContentAfterSave event.
            $dispatcher->trigger($this->event_after_save, array($this->option . '.' . $this->name, $table, $isNew));
        }
        catch (Exception $e)
        {
            $this->setError($e->getMessage());

            return false;
        }

        $pkName = $table->getKeyName();

        if (isset($table->$pkName))
        {
            $this->setState($this->getName() . '.id', $table->$pkName);
        }
        $this->setState($this->getName() . '.new', $isNew);

        return true;
    }
	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
            $id = intval($item->id);
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*')
                  ->from('#__ccgslider_slider_mapping')
                 ->where('sliderid =' . $id);
            $db->setQuery($query);
            $picture = $db->loadObjectList();
            $item->picture= $picture;

		}

		return $item;
	}

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id)) {

			// Set ordering to the last item if not set
			if (@$table->ordering === '') {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__ccgslider_slider');
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}

		}
	}
    /**
     * Prepare and sanitise the table prior to saving.
     * @param  Int  $id
     * @param  String  $folder
     * @since	1.6
     */
    public function saveTheFile($id, $folder){
        $path = JPATH_ROOT . "/images/" . $folder;
        $files = JFolder::files($path);
        $db = JFactory::getDbo();
        $deletequery = $db->getQuery(true);
        $deletequery->delete("#__ccgslider_slider_mapping")
              ->where('id =' . $id);
        $db->setQuery($deletequery);
        $db->execute();
        $columns = array('sliderid', 'file');
        $addquery =  $db->getQuery(true);
        $addquery->insert('#__ccgslider_slider_mapping')->columns($db->quoteName($columns));
        foreach($files as $file){
            $doc = $db->quote("$folder/$file");
            $addquery->values($id . ", $doc" );

        }

        $db->setQuery($addquery);
        if(!$db->execute())
            return false;
        return true;
    }

}