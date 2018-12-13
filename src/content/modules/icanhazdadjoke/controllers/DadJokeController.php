<?php
use UliCMS\Security\PermissionChecker;

class DadJokeController extends MainClass
{

    const MODULE_NAME = "icanhazdadjoke";

    public function render()
    {
        return UliCMS\HTML\text($this->getDadJoke());
    }

    public function getDadJoke()
    {
        $ch = curl_init();
        $headers = array(
            'Accept: text/plain'
        );
        
        $url = "https://icanhazdadjoke.com";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, ULICMS_USERAGENT);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200 and curl_getinfo($ch, CURLINFO_HTTP_CODE) != 304 and curl_getinfo($ch, CURLINFO_HTTP_CODE) != 302) {
            return get_translation("download_failed");
        }
        
        curl_close($ch);
        return $result;
    }

    public function accordionLayout()
    {
        $acl = new PermissionChecker(get_user_id());
        if ($acl->hasPermission("icanhazdadjoke")) {
            return Template::executeModuleTemplate(self::MODULE_NAME, "dashboard.php");
        }
        return "";
    }
}