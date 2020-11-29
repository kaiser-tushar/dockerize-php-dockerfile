<?php
namespace App\Controllers;

use App\Controllers\CoreController;
use Nahid\JsonQ\Jsonq;

class CountryController extends CoreController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        try{
            $query = isset($_GET["search"])?$_GET["search"]:'';
            $jsonq = new Jsonq('countries.json');
            if(!empty($query)){
                $jsonq->where('name', 'contains', ucfirst($query));
            }
            $countries = $jsonq->select('name','file_url')->get()->toArray();
            $result = [];
            if(!empty($countries)){
                foreach($countries as $country){
                    $result[] = [
                       'country' =>  $country['name'],
                        'image' => $country['file_url']
                    ];
                }
            }
            return $this->jsonResponse($result);
        }catch(Exception $ex){
            return $this->jsonResponse($ex->getMessage(),ture,500);
        }
    }
    public function view()
    {
        try{
            $query = isset($_GET["search"])?$_GET["search"]:'';
            $jsonq = new Jsonq('countries.json');
            if(!empty($query)){
                $jsonq->where('name', 'contains', ucfirst($query));
            }
            $result = $jsonq->select('name','file_url','url')->first()->toArray();
            return $this->jsonResponse($result);
        }catch(Exception $ex){
            return $this->jsonResponse($ex->getMessage(),ture,500);
        }
    }

}