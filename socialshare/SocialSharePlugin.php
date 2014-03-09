<?php

/**
 * SocialShare
 *
 * @package     SocialShare
 * @version     Version 0.1
 * @author      Jake Chapman
 * @copyright   Copyright (c) 2014
 * @link        imjakechapman.com
 *
 */

namespace Craft;

class SocialSharePlugin extends BasePlugin
{
    /**
     * Get Name
     */
    function getName()
    {
        return Craft::t('SocialShare');
    }
    
    // --------------------------------------------------------------------

    /**
     * Get Version
     */
    function getVersion()
    {
        return '0.1';
    }
    
    // --------------------------------------------------------------------

    /**
     * Get Developer
     */
    function getDeveloper()
    {
        return 'Jake Chapman';
    }
    
    // --------------------------------------------------------------------

    /**
     * Get Developer URL
     */
    function getDeveloperUrl()
    {
        return 'http://imjakechapman.com';
    }

    // --------------------------------------------------------------------

    /**
     * Has CP Section
     */
    public function hasCpSection()
    {
        return false;
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.socialshare.twigextensions.SocialShareTwigExtension');
        return new SocialShareTwigExtension();
    }
}