<?php
/**
 * InternalWhitelist
 * Author:  Lisa Ridley
 * Date:  2 Jul 2008
 * Version 0.8 beta
 * Copyright (C) 2008 Lisa Ridley
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You can find a copy of the GNU General Public License at http://www.gnu.org/copyleft/gpl.html
 * A paper copy can be obtained by writing to:  Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
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

$wgExtensionCredits['other'][] = array(
    'name' => 'InternalWhitelist',
    'author' => 'Lisa Ridley',
    'url' => 'https://www.mediawiki.org/wiki/Extension:InternalWhitelist',
    'version' => '0.8 beta',
    'description' => 'Allows for the maintenance of "whitelisted" pages in the MediaWiki namespace',
);

$wgExtensionFunctions[] = 'fnInternalWhitelistSetup';

/**
 * extension setup
 */
function fnInternalWhitelistSetup(){
    global $wgHooks, $wgGroupPermissions;
    $wgGroupPermissions['*']['read'] = false;
    $wgHooks['UserGetRights'][] = 'fnInternalWhitelist';
}
/**
 * Adds pages listed in MediaWiki:Whitelist to $wgWhitelistRead
 * Always returns true so that other extensions using the UserGetRights hook
 * will be executed
 *
 * @params $user User object
 * @params $rights array of user rights
 * @return boolean true
 */
function fnInternalWhitelist($user, $rights){
    global $wgWhitelistRead;
    /** if user is not anonymous, then exit the script **/
    if(!$user->isAnon()){
        return true;
    }
    $pagearray = explode("\n", wfMessage( 'Whitelist' )->inContentLanguage()->text() );
    foreach($pagearray as $arg){
        if (strpos($arg, '//') !== false) {
            continue;
        }
        $wgWhitelistRead[]=trim(trim($arg, "*"));
    }
    return true;
}
