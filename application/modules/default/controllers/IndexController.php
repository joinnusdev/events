<?php

class Default_IndexController extends App_Controller_Action_Portal
{

    public function init()
    {
        parent::init();
        /* Initialize action controller here */        
    }
    
    public function indexAction()
    {       	
        
    // Cargar la estampa y la foto para aplicarle la marca de agua
        
    
    $e = $this->config->app->elementsRoot."/marca.jpeg";
    $ima = $this->config->app->elementsRoot."/1.jpeg";


$estampa = imagecreatefromjpeg($e);
$im = imagecreatefromjpeg($ima);
$margen_dcho = 10;
$margen_inf = 10;
$sx = imagesx($estampa);
$sy = imagesy($estampa);

imagecopymerge($im, $estampa, 
    imagesx($im) - $sx - $margen_dcho, 
    imagesy($im) - $sy - $margen_inf, 
    0, 0, 
    imagesx($estampa), 
    imagesy($estampa), 
    70
    );
// Guardar la imagen en un archivo y liberar memoria

imagejpeg($im, $ima);
imagedestroy($im);
    
        
    }
    public function index2Action()
    {       
        
    }    

}

