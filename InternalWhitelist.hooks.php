<?php
class InternalWhitelistHooks {
    public static function onUserGetRights($user, &$aRights){
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
}

