<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

Abstract class CoreController{

    public function __construct()
    {
    }
    /*
     * Check various function success or failure response
     *
     * @return - true if success response otherwise false
     */
    public function isSuccessResponse($response){
        if(isset($response['status']) && $response['status'] == 'success'){
            return true;
        }
        return false;
    }
    /*
     * Prepare Json response and send to browser
     */
    public function jsonResponse($response,$replace = true,$status = 200){
        header('Content-Type: application/json');
        echo json_encode($response,$replace,$status);
    }
    /*
     * Twig template to load a view
     *
     * Search in src/Views folder
     *
     * @param string $path to load a view
     * @param array $data to send any required data in a view
     *
     * @return HTML view
     */
    protected function loadView($path = '',$data = []){
        if(!empty($path)){
            $exploded_path = explode('.',$path);
            $total_index = count($exploded_path);
            $filename = $exploded_path[$total_index-1].'.html';
            if($total_index > 1){
                $extra_path = array_slice($exploded_path,0,$total_index-1);
                $path = 'src/Views/'.implode('/',$extra_path);
            } else{
                $path = 'src/Views';
            }
        }
        $loader = new FilesystemLoader([$path,'src/Views']);
        $twig = new Environment($loader);

        echo $twig->render($filename,$data);
    }

}