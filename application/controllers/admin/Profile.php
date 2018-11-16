<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {



    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
        
        // Load database
        $this->load->model('common_model');
        //$this->load->model('admin/Profile_model');
        $this->lang->load('profile');
        
        }  else {
            redirect('admin/login');
        }
    } //function ends

    

    public function change()
    {
        
        if($this->session->userdata('logged_in') && $this->session->userdata('MemberID')) 
        {
            
            if($this->input->post())
            {               
                $minst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='minuserpasswordlength'","arm_setting");
                $maxst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='maxuserpasswordlength'","arm_setting");
                
                $this->form_validation->set_rules('newpassword', 'newpassword', 'trim|required|min_length[6]|max_length[12]|callback_passmatch_check|callback_passprematch_check');
                $this->form_validation->set_rules('currentpassword', 'currentpassword', 'trim|required|callback_password_check');

                
                if($this->form_validation->run() == true )
                {
                        $data = array('Password'=>SHA1(SHA1($this->input->post('newpassword'))));
                        $condition= "MemberId='".$this->session->userdata('MemberID')."' AND UserType IN ('1','2')";
                        $result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
                        
                    
                    $this->session->set_flashdata('success_message',$this->lang->line('successmessagepass'));
                    redirect('admin/profile/change');
                }

                else
                {
                
                $this->session->set_flashdata('error_message',$this->lang->line('errormessagepass'));
                        
                $this->load->view('admin/updatepassword');
                }

                
            }
            else
            {
                
                $this->load->view('admin/updatepassword');
                // $this->load->view('admin/generalsetting');
            } 
        }
        else
        {
            redirect('admin/login');

                    
        }       
    }

    public function passmatch_check()
    {
        if($this->input->post('newpassword') == $this->input->post('repeatpassword'))
        {

            return true; 
        }
        else{

            $this->form_validation->set_message('passmatch_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorpasswordmatch')).'</em></p>');
            return false;
            }
    }

    public function passprematch_check()
    {
        if($this->input->post('newpassword') == $this->input->post('currentpassword'))
        {
            $this->form_validation->set_message('passprematch_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorpasswordprematch')).'</em></p>');
            return false;
        }
        else
        {
            return true; 
        }
    }


    public function password_check()
    {
        $condition = "MemberId =" . "'" . $this->session->userdata('MemberID'). "' AND Password =" . "'" . sha1(sha1($this->input->post('currentpassword'))). "' AND UserType IN ('1','2')";

            $this->db->select('*');
            $this->db->from('arm_members');
            $this->db->where($condition);
            $query = $this->db->get();
            if ($query->num_rows()>0) 
            {
                return true; 
            }
            else
            {

                $this->form_validation->set_message('password_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorpassword')).'</em></p>');
                return false;
            }


    }

    public function index()
    {
        
        if($this->session->userdata('logged_in')) 
        {
            
            if($this->input->post())
            {               
                $this->form_validation->set_rules('update', 'update', 'trim|required');
                
                if($this->form_validation->run() == true )
                {
                    $profile_img = 'uploads/UserProfileImage/'.$this->session->userdata('MemberID').'.jpg';
                    

                if($_FILES['profileimage']['tmp_name']!='')
                { 

                    $config['upload_path'] = './uploads/UserProfileImage/';
                    $config['allowed_types'] = '*';
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('profileimage')) {
                                    $upload_files = 0;
                                     $this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
                                        $this->data['field']= $this->common_model->GetCustomer($this->session->userdata('MemberID'));
                                        $this->data['ProfileImage'] =$this->data['field']->ProfileImage;
                                        $this->load->view('admin/updateprofile');
                                    $data = array('ProfileImage'=> '');


                                    
                                } else {
                                    $data = array('ProfileImage'=> $this->upload->data('file_name'));
                                    $upload_files = 1;
                                }
                }
                        $condition= "MemberId='".$this->session->userdata('MemberID')."'";
                        $result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
                        
                    
                    $this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
                    redirect('admin/profile');
                }

               
                
               
                

                
            }
            else
            {
                $this->data['field']= $this->common_model->GetCustomer($this->session->userdata('MemberID'));
                
                $this->data['ProfileImage']=$this->data['field']->ProfileImage;
                $this->load->view('admin/updateprofile',$this->data);
                // $this->load->view('admin/generalsetting');
            } 
        }
        else
        {
            redirect('admin/login');

                    
        }


        

        }




    } //class ends


