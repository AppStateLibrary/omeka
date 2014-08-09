<?php

define('SOCIAL_BOOKMARKING_VERSION', get_plugin_ini('SocialBookmarking', 'version'));

add_plugin_hook('install', 'social_bookmarking_install');
add_plugin_hook('uninstall', 'social_bookmarking_uninstall');
add_plugin_hook('upgrade', 'social_bookmarking_upgrade');
add_plugin_hook('config', 'social_bookmarking_config');
add_plugin_hook('config_form', 'social_bookmarking_config_form');
add_plugin_hook('public_append_to_items_show', 'social_bookmarking_append_to_item');

function social_bookmarking_install() 
{
	$socialBookmarkingServices = array(
	'delicious' 		=> 	true,
	'digg' 				=> 	true,
	'furl' 				=> 	true,
	'blinklist'			=>	false,
	'reddit'			=> 	true,
	'feed_me'			=>	false,
	'technorati'		=>	true,
	'yahoo'				=>	true,
	'newsvine'			=>	true,
	'socializer'		=>	false,
	'stumbleupon'		=>	false,
	'google'			=>	false,
	'squidoo'			=>	false,
	'netvouz'			=>	false,
	'blogmarks'			=>	false,
	'comments'			=>	false,
	'bloglines'			=>	false,
	'scoopeo'			=>	false,
	'blogmemes'			=>	false,
	'blogspherenews'	=>	false,
	'blogsvine'			=>	false,
	'mixx'				=>	false,
	'netscape'			=>	false,
	'ask'				=>	false,
	'linkagogo'			=>	false,
	'socialdust'		=>	false,
	'live'				=>	false,
	'slashdot'			=>	false,
	'sphinn'			=>	false,
	'facebook'			=>	false,
	'myspace'			=>	false,
	'connotea'			=>	false,
	'misterwong'		=>	false,
	'barrapunto'		=>	false,
	'twitter'			=>	false,
	'segnalo'			=>	false,
	'oknotizie'			=>	false,
	'diggita'			=>	false,
	'seotribu'			=>	false,
	'upnews'			=>	false,
	'wikio'				=>	false,
	'notizieflash'		=>	false,
	'kipapa'			=>	false,
	'fai_informazione'	=>	false,
	'bookmark_it'		=>	false,
	'ziczac'			=>	false,
	'plim'				=>	false,
	'technotizie'		=>	false,
	'diggitsport'		=>	false
	);
	
	set_option('social_bookmarking_version', SOCIAL_BOOKMARKING_VERSION);
	set_option('social_bookmarking_services', serialize($socialBookmarkingServices));	
}

function social_bookmarking_uninstall()
{
	delete_option('social_bookmarking_version');
	delete_option('social_bookmarking_services');
}

function social_bookmarking_upgrade($oldVersion, $newVersion)
{ 
    if (version_compare($oldVersion, '1.0.1', '<=') )
    {
        $servicesToRemove = array(
                            'blinkbits', 
                            'bluedot',
                            'delirious',
                            'healthranker',
                            'indianpad',
                            'leonaut',
                            'magnolia', 
                            'rawsugar',
                            'rojo',
                            'scuttle',
                            'simpy',
                            'tailrank'
                            );
        
        $currentServices = social_bookmarking_get_services();
        
        foreach ($servicesToRemove as $remove) {
            unset($currentServices[$remove]);
        }
        
        $newServices = serialize($currentServices);
        
        set_option('social_bookmarking_services', $newServices);
    }
}

function social_bookmarking_config() 
{
	$socialBookmarkingServices = social_bookmarking_get_services();
	
	unset($_POST['install_plugin']);
		
	$foo = serialize($_POST);
	
	set_option('social_bookmarking_services', $foo);
}

function social_bookmarking_config_form() 
{
    include 'config_form.php';
}

function social_bookmarking_append_to_item()
{
    echo '<h2>Social Bookmarking</h2>';
    $socialBookmarkingServices = social_bookmarking_get_services();
	foreach ($socialBookmarkingServices as $service => $value) {
		if ($value == false) continue;
		$site = social_bookmarking_get_service_props($service);
		$targetHref = str_replace('{title}', urlencode(strip_formatting(item('Dublin Core', 'Title'))), $site->url);
		$targetHref = str_replace('{link}', abs_item_uri(), $targetHref);
		
		$image = img($site->img);
		
        $serviceIcon = '<a class="social-img" href="'.$targetHref.'" title="'.$site['name'].'"><img src="'.$image.'" /></a>';
        echo $serviceIcon;
	}
}

function social_bookmarking_get_services() 
{
	$services = unserialize(get_option('social_bookmarking_services'));
	ksort($services);
	return $services;
}

function social_bookmarking_get_service_props($service)
{
    static $xml = null;
    if (!$xml) {
        $file = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'services.xml');
        $xml = new SimpleXMLElement($file);
    }

    foreach ($xml->site as $site) {
        if ($site->key != $service) continue;
        return $site;
    }
}