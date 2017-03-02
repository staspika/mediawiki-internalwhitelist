<?php
/*
 * To install this extension, save this file in the "extensions" folder of your
 *   MediaWiki installation, and add the following to LocalSettings.php
 *
 *   $wgGroupPermissions['*']['read'] = false;
 *   require_once("$IP/extensions/InternalWhitelist.php");
 *
 * Note:  any settings already established in $wgWhitelistRead will be discarded
 *  and the "internal whitelist" will be utilized instead.
 *
 * The "internal whitelist" is stored at MediaWiki:Whitelist.
 *
 * Comments can be noted in the page by preceding a line with double slashes, like so:
 *    //This is a comment line
 *
 * The articles to be whitelisted are listed in bullet form, with any namespace
 *  prefixes; the actual article name can be entered with or without underscores
 *  for spaces.
 *
 * For example, to whitelist the Main Page, Special:RecentChanges, and the
 * discussion page for the Main Page, the contents of MediaWiki:Whitelist would
 * look like:
 *            //This is the internal whitelist
 *            //Articles
 *            * Main Page
 *            //Discussion pages
 *            * Talk:Main Page
 *            //Special Pages
 *            * Special:RecentChanges
 *
 */

if ( !defined( 'MEDIAWIKI' ) ) {
        die( 'This file is an extension to MediaWiki and thus not a valid entry point.' );
}

class InternalWhitelist {
    public function Setup(){
        global $wgGroupPermissions;
        $wgGroupPermissions['*']['read'] = false;
    }
}

#$wgExtensionFunctions[] = 'InternalWhitelist::Setup';
