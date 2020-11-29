<?php
namespace App\Core;

Class Config {
    /*
     * Define environment to control error reporting
     *
     * possible values
     * - development - All error will be reported.
     * - testing - No error will be reported
     * - production - No error will be reported
     */
    private $environment = 'development';

    /*
     * Which controller will load by default
     *
     * Happens when user browse the site on main URL
     *
     * Set to Home means it will go to src/Controller/HomeController.php
     */
    private $landingPageController = 'Home';

    public function __construct()
    {
        switch ($this->environment)
        {
            case 'development':
                error_reporting(E_ALL);
                break;

            case 'testing':
            case 'production':
                error_reporting(0);
                break;

            default:
                exit('The application environment is not set correctly.');
        }
    }
    /*
     * Send Default Controller Name
     *
     * Used when User hit main URL
     *
     * @return string  prefix name of the controller[need to add controller.php at the end]
     */
    public function getLandingPageControllerName(){
        return $this->landingPageController;
    }
}
