<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Service_model (Service Model)
 * Service model class to get to handle user related data 
 * @author : Neeraj Malkani
 * @version : 1.1
 * @since : 26 Apr 2020
 */
class Service_model extends CI_Model
{
    public $table = 'tbl_service_repository';

    public function totalServices()
    {
        return $this->db->count_all_results($this->table);
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function serviceListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($this->table.' as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.applicationId  LIKE '%".$searchText."%'
                            OR  BaseTbl.domain_range  LIKE '%".$searchText."%'
                            OR  BaseTbl.msgId  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function serviceListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($this->table.' as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.applicationId  LIKE '%".$searchText."%'
                            OR  BaseTbl.domain_range  LIKE '%".$searchText."%'
                            OR  BaseTbl.msgId  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewService($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getServiceInfo($id)
    {
        $query = $this->db->get($this->table);
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editService($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteService($id)
    {
        $this->db->delete('tbl_users', array('id' => $id));
        
        return $this->db->affected_rows();
    }
}

  