<?php
class InternalWhitelistHooks {
    public static function onUserGetRights($user, &$aRights){
        global $wgWhitelistRead;
        # If user is not anonymous, then exit the script
        if( !$user->isAnon() ) {
            return true;
        }
        $pagearray = explode("\n", wfMessage( 'Whitelist' )->text());
        foreach($pagearray as $arg ) {
            # Find lines starting with one or more `*`, preceeded by zero or more whitespaces
            $has_match = preg_match('/\**\s*(.*)/', $arg, $matches);
            if ($has_match == 1) {
                $wgWhitelistRead[]=trim(trim($arg, "*"));
            }
        }
        return true;
    }
}
