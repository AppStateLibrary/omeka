<?php
/**
 * @package AtomOutput
 * @copyright Copyright (c) 2009 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

add_filter('define_response_contexts', 'AtomOutputPlugin::defineResponseContexts');
add_filter('define_action_contexts', 'AtomOutputPlugin::defineActionContexts');

/**
 * Class containing plugin hooks and filters,
 *
 * @package AtomOutput
 */
class AtomOutputPlugin
{   
    /**
     * Define response contexts filter.
     * 
     * @param array List of response contexts.
     * @return array
     */
    public static function defineResponseContexts($contexts)
    {
        // Set the atom response context.
        $contexts['atom'] = array('suffix' => 'atom', 
                                  'headers' => array('Content-Type' => 'text/xml'));
        return $contexts;
    }
    
    /**
     * Define action contexts filter.
     * 
     * @param array List of action contexts.
     * @return array
     */
    public static function defineActionContexts($contexts, $controller)
    {
        // Only set the atom context while in the items controller browse action.
        if ($controller instanceof ItemsController) {
            $contexts['browse'][] = 'atom';
        }
        return $contexts;
    }
}