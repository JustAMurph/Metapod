<?php 

/* 
*
* A class that watches for changes and writes the results to the injected logger. 
*
*/

class WatchDog {

    private $log;
    private $user;
    private $watchFilesDefaultHooks = array('load-theme-editor.php', 'load-plugin-editor.php');


    public function __construct($logger){
        $this->log = $logger;
    }

    public function watchFiles($files = array()){
        if(empty($files)){
            $files = $this->watchFilesDefaultHooks;
        }

        foreach($files as $file){
            add_action($file, array($this, 'fileLoaded'));
        }
    }

    public function fileLoaded(){

        $file = 'Default';
        if(isset($_GET['file'])){
            $file = $_GET['file'];
        }

        $mode = 'editing';
        if(isset($_GET['updated'])){
            $mode = 'saving';
        }

        $user = wp_get_current_user();
        $formattedString = sprintf('%s %s %s %s', Metapod::getDateTime(), $user->user_login, $mode, $file);

        $this->log->write('edit', $formattedString );
    }


    public function watchLogin(){
        add_action ('wp_login_success' , array($this, 'adminLoggedIn'));
    }

    public function adminLoggedIn($username){


        if (!username_exists($username)) {
            return;
        }
        
        $userinfo = get_user_by('login', $username);

        $this->log->write('login',  Metapod::getDateTime() . ' - ' .  $userinfo->user_login);
    }
}