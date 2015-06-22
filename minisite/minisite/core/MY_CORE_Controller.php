<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        //$this->load->helper('url');

    }//end __construct()

}//end Base_Controller

class MY_Front_Controller extends Base_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        //load libraries
    }

    /**
     * This works exactly like the regular $this->load->view()
     * The difference is it automatically pulls in a header and footer.
     */
    public function view($view, $string = false)
    {
        if ($string) {
            $result	= $this->load->view($view, true);
            return $result;
        } else {
            $this->load->view($view);
        }
    }

}
class MY_Admin_Controller extends Base_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        //load libraries
    }

    /**
     * This works exactly like the regular $this->load->view()
     * The difference is it automatically pulls in a header and footer.
     */
    public function view($view, $string = false)
    {
        if ($string) {
            $result = $this->load->view($view, true);
            return $result;
        } else {
            $this->load->view($view);
        }
    }

}