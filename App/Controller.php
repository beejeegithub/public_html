<?php

namespace App;

use App;

class Controller 
{
    public $layoutFile = 'Views/Layout.php';

    public $layoutadminFile = 'Views/Layout_admin.php';

    public $layoutauthorizationFile = 'Views/Layout_authorization.php';

    public function renderLayout ($body) 
    {
        ob_start();
        require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Layout'.DIRECTORY_SEPARATOR."Layout.php";
        return ob_get_clean();      
    }

    public function renderadminLayout ($bodyadmin) 
    {
        ob_start();
        require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Layout'.DIRECTORY_SEPARATOR."Layout_admin.php";
        return ob_get_clean();   
    }

    public function renderauthorizationLayout ($bodyauthorization) 
    {
        ob_start();
        require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Layout'.DIRECTORY_SEPARATOR."Layout_authorization.php";
        return ob_get_clean();    
    }

    public function render ($viewName, array $params = [])
    {
        $viewFile = ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$viewName.'.php';
        extract($params);
        ob_start();
        require $viewFile;
        $body = ob_get_clean();
        ob_end_clean();
        return $this->renderLayout($body);
    }

    public function renderadmin ($viewName, array $params = [])
    {
        $viewFile = ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$viewName.'.php';
        extract($params);
        ob_start();
        require $viewFile;
        $bodyadmin = ob_get_clean();
        ob_end_clean();
        return $this->renderadminLayout($bodyadmin);
    }

    public function renderauthorization ($viewName, array $params = [])
    {
        $viewFile = ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$viewName.'.php';
        extract($params);
        ob_start();
        require $viewFile;
        $bodyauthorization = ob_get_clean();
        ob_end_clean();
        return $this->renderauthorizationLayout($bodyauthorization);
    }
}
?>