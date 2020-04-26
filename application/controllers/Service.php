<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Service (ServiceController)
 * Service Class to control all user related operations.
 * @author : Neeraj Malkani
 * @version : 1.1
 * @since : 26 Apr 2020
 */
class Service extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        
        $this->load->library('pagination');
        
        $count = $this->service_model->serviceListingCount($searchText);

        $returns = $this->paginationCompress("index/", $count, 10 );
        
        $data['records'] = $this->service_model->serviceListing($searchText, $returns["page"], $returns["segment"]);
        
        $this->global['pageTitle'] = 'CodeInsect : Service Listing';
        
        $this->loadViews("services", $this->global, $data, NULL);
    }
    
    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        $this->global['pageTitle'] = 'CodeInsect : Add New Service';

        $this->loadViews("addNewService", $this->global, NULL, NULL);
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewService()
    {
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('applicationId','Application Id','trim|required|max_length[255]');
        $this->form_validation->set_rules('domain_range','Domain Range','trim|required|max_length[255]');
        $this->form_validation->set_rules('msgId','Msg ID','trim|required|max_length[255]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $now = date('Y-m-d H:i:s');
            $data['applicationId'] = $this->security->xss_clean($this->input->post('applicationId'));
            $data['text'] = $this->security->xss_clean($this->input->post('short_text'));
            $data['domain_range'] = $this->security->xss_clean($this->input->post('domain_range'));
            $data['msgId'] = $this->security->xss_clean($this->input->post('msgId'));
            $data['oir'] = $this->security->xss_clean($this->input->post('oir'));
            $data['log_level'] = $this->security->xss_clean($this->input->post('log_level'));
            $data['message'] = $this->security->xss_clean($this->input->post('message'));
            $data['trouble_ins'] = $this->security->xss_clean($this->input->post('trouble_ins'));
            $data['created_at'] = $now;
            $data['updated_at'] = $now;

            $result = $this->service_model->addNewService($data);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Service created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Service creation failed');
            }
            
            redirect('service/addNew');
        }
    }

    
    /**
     * This function is used load service edit information
     * @param number $id : Optional : This is service id
     */
    function editOld($id = NULL)
    {
        if($id == null)
        {
            redirect('services');
        }
        
        $data['serviceInfo'] = $this->service_model->getServiceInfo($id);
        
        $this->global['pageTitle'] = 'CodeInsect : Edit Service';
        
        $this->loadViews("editOldService", $this->global, $data, NULL);
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editService()
    {
        $this->load->library('form_validation');
        
        $id = $this->input->post('id');
        
        $this->form_validation->set_rules('applicationId','Application Id','trim|required|max_length[255]');
        $this->form_validation->set_rules('domain_range','Domain Range','trim|required|max_length[255]');
        $this->form_validation->set_rules('msgId','Msg ID','trim|required|max_length[255]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->editOld($id);
        }
        else
        {
            $now = date('Y-m-d H:i:s');
            $data['applicationId'] = $this->security->xss_clean($this->input->post('applicationId'));
            $data['text'] = $this->security->xss_clean($this->input->post('short_text'));
            $data['domain_range'] = $this->security->xss_clean($this->input->post('domain_range'));
            $data['msgId'] = $this->security->xss_clean($this->input->post('msgId'));
            $data['oir'] = $this->security->xss_clean($this->input->post('oir'));
            $data['log_level'] = $this->security->xss_clean($this->input->post('log_level'));
            $data['message'] = $this->security->xss_clean($this->input->post('message'));
            $data['trouble_ins'] = $this->security->xss_clean($this->input->post('trouble_ins'));
            $data['updated_at'] = $now;
            
            $result = $this->service_model->editService($data, $id);
            
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Service updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Service updation failed');
            }
            
            redirect('services');
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteService()
    {
        $id = $this->input->post('id');
        
        $result = $this->service_model->deleteService($id);
        
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>