<?php if ( !defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

    class Exam extends Admin_Controller
    {
        /*
        | -----------------------------------------------------
        | PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
        | -----------------------------------------------------
        | AUTHOR:			INILABS TEAM
        | -----------------------------------------------------
        | EMAIL:			info@inilabs.net
        | -----------------------------------------------------
        | COPYRIGHT:		RESERVED BY INILABS IT
        | -----------------------------------------------------
        | WEBSITE:			http://inilabs.net
        | -----------------------------------------------------
        */
        public $notdeleteArray = [1];

        public function __construct()
        {
            parent::__construct();
            $this->load->model("exam_m");
            $this->load->library('updatechecker');
            $this->data['notdeleteArray'] = $this->notdeleteArray;
            $language = $this->session->userdata('lang');
            $this->lang->load('exam', $language);
        }

        public function index()
        {
            $this->data['exams']   = $this->exam_m->get_order_by_exam();
            $this->data["subview"] = "exam/index";
            $this->load->view('_layout_main', $this->data);
        }

        public function add()
        {
            $this->data['headerassets'] = [
                'css' => [
                    'assets/datepicker/datepicker.css',
                    'assets/select2/css/select2.css',
                    'assets/select2/css/select2-bootstrap.css'
                ],
                'js'  => [
                    'assets/datepicker/datepicker.js',
                    'assets/select2/select2.js'
                ]
            ];
            if ( $_POST ) {
                $rules = $this->rules();
                $this->form_validation->set_rules($rules);
                if ( $this->form_validation->run() == false ) {
                    $this->data['form_validation'] = validation_errors();
                    $this->data["subview"]         = "exam/add";
                    $this->load->view('_layout_main', $this->data);
                } else {
                    if ( config_item('demo') == false ) {
                        $updateValidation = $this->updatechecker->verifyValidUser();
                        if ( $updateValidation->status == false ) {
                            $this->session->set_flashdata('error', $updateValidation->message);
                            redirect(base_url('exam/add'));
                        }
                    }

                    $array["exam"]      = $this->input->post("exam");
                    $array["exam_year"] = $this->input->post("exam_year");
                    $array["date"]      = date("Y-m-d", strtotime($this->input->post("date")));
                    $array["note"]      = $this->input->post("note");

                    $this->exam_m->insert_exam($array);
                    $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                    redirect(base_url("exam/index"));
                }
            } else {
                $this->data["subview"] = "exam/add";
                $this->load->view('_layout_main', $this->data);
            }
        }

        protected function rules()
        {
            $rules = [
                [
                    'field' => 'exam',
                    'label' => $this->lang->line("exam_name"),
                    'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_exam'
                ],
                [
                    'field' => 'date',
                    'label' => $this->lang->line("exam_date"),
                    'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
                ],
                [
                    'field' => 'exam_year',
                    'label' => 'Exam Year',
                    'rules' => 'trim|required|max_length[20]|xss_clean'
                ],
                [
                    'field' => 'note',
                    'label' => $this->lang->line("exam_note"),
                    'rules' => 'trim|max_length[200]|xss_clean'
                ]
            ];
            return $rules;
        }

        public function edit()
        {
            $this->data['headerassets'] = [
                'css' => [
                    'assets/datepicker/datepicker.css',
                    'assets/select2/css/select2.css',
                    'assets/select2/css/select2-bootstrap.css'
                ],
                'js'  => [
                    'assets/datepicker/datepicker.js',
                    'assets/select2/select2.js'
                ]
            ];

            $examID = htmlentities(escapeString($this->uri->segment(3)));
            if ( (int) $examID ) {
                $this->data['exam'] = $this->exam_m->get_exam($examID);
                if ( $this->data['exam'] ) {
                    if ( $_POST ) {
                        $rules = $this->rules();
                        $this->form_validation->set_rules($rules);
                        if ( $this->form_validation->run() == false ) {
                            $this->data["subview"] = "exam/edit";
                            $this->load->view('_layout_main', $this->data);
                        } else {
                            $array["exam"]      = $this->input->post("exam");
                            $array["exam_year"] = $this->input->post("exam_year");
                            $array["date"]      = date("Y-m-d", strtotime($this->input->post("date")));
                            $array["note"]      = $this->input->post("note");

                            $this->exam_m->update_exam($array, $examID);
                            $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                            redirect(base_url("exam/index"));
                        }
                    } else {
                        $this->data["subview"] = "exam/edit";
                        $this->load->view('_layout_main', $this->data);
                    }
                } else {
                    $this->data["subview"] = "error";
                    $this->load->view('_layout_main', $this->data);
                }
            } else {
                $this->data["subview"] = "error";
                $this->load->view('_layout_main', $this->data);
            }

        }

	

        public function uploadadmitcard()
        {
            

            $examID = htmlentities(escapeString($this->uri->segment(3)));
            if ( (int) $examID ) {
                $this->data['exam'] = $this->exam_m->get_exam($examID);
                if ( $this->data['exam'] ) {
                    if ( $_POST ) {
                        $rules = $this->rules();
                        $this->form_validation->set_rules($rules);
                        if ( $this->form_validation->run() == false ) {
                            $this->data["subview"] = "exam/edit";
                            $this->load->view('_layout_main', $this->data);
                        } else {
                            $array["exam"]      = $this->input->post("exam");
                            $array["exam_year"] = $this->input->post("exam_year");
                            $array["date"]      = date("Y-m-d", strtotime($this->input->post("date")));
                            $array["note"]      = $this->input->post("note");

                            $this->exam_m->update_exam($array, $examID);
                            $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                            redirect(base_url("exam/index"));
                        }
                    } else {
                        $this->data["subview"] = "exam/upload";
                        $this->load->view('_layout_main', $this->data);
                    }
                } else {
                    $this->data["subview"] = "error";
                    $this->load->view('_layout_main', $this->data);
                }
            } else {
                $this->data["subview"] = "error";
                $this->load->view('_layout_main', $this->data);
            }

        }

        function doupload(){ 
        if(!empty($_FILES)){ 
             $examID = htmlentities(escapeString($this->uri->segment(3)));

              if(!is_dir('uploads/exam/'.$examID)) {
               mkdir('uploads/exam/'.$examID);
           }
            // File upload configuration 
            $uploadPath = 'uploads/exam/'.$examID; 
            $config['upload_path'] = $uploadPath; 
            $config['allowed_types'] = '*'; 
            $config['overwrite'] = TRUE;
             
            // Load and initialize upload library 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
             
            // Upload file to the server 
            if($this->upload->do_upload('file')){ 
                $fileData = $this->upload->data(); 
                $uploadData['file_name'] = $fileData['file_name']; 
                $uploadData['uploaded_on'] = date("Y-m-d H:i:s");

                var_dump($uploadData); 
                 
                // Insert files info into the database 
               // $insert = $this->file->insert($uploadData); 
            } 
        } 
    }

    public function delete() {
		$examID = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$examID && !in_array($examID, $this->notdeleteArray)) {
			$this->exam_m->delete_exam($examID);
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
			redirect(base_url("exam/index"));
		} else {
			redirect(base_url("exam/index"));
		}
	}

        public function unique_exam()
        {
            $examID = htmlentities(escapeString($this->uri->segment(3)));
            if ( (int) $examID ) {
                $exam = $this->exam_m->get_order_by_exam([ 'examID' => $examID, 'examID !=' => $examID ]);
                if ( customCompute($exam) ) {
                    $this->form_validation->set_message("unique_exam", "The %s already exists");
                    return false;
                }
            } else {
                $exam = $this->exam_m->get_order_by_exam([ 'examID' => $examID ]);
                if ( customCompute($exam) ) {
                    $this->form_validation->set_message("unique_exam", "The %s already exists");
                    return false;
                }
            }
            return true;
        }

        public function date_valid( $date )
        {
            if ( strlen($date) < 10 ) {
                $this->form_validation->set_message("date_valid", "The %s is not valid dd-mm-yyyy");
                return false;
            } else {
                $arr  = explode("-", $date);
                $dd   = $arr[0];
                $mm   = $arr[1];
                $yyyy = $arr[2];
                if ( checkdate($mm, $dd, $yyyy) ) {
                    return true;
                } else {
                    $this->form_validation->set_message("date_valid", "The %s is not valid dd-mm-yyyy");
                    return false;
                }
            }

        }

        public function unique_data( $data )
        {
            if ( $data != '' ) {
                if ( $data == '0' ) {
                    $this->form_validation->set_message('unique_data', 'The %s field is required.');
                    return false;
                }
            }
            return true;
        }



    public function active() {
        if(permissionChecker('exam_edit')) {
            $id     = $this->input->post('id');
            $status = $this->input->post('status');
            if($id != '' && $status != '') {
                if((int)$id) {
                    
                    $exam = $this->exam_m->get_single_exam(array('examID' => $id));
                    if(customCompute($exam)) {
                        if($status == 'chacked') {
                            $this->exam_m->update_exam(array('active' => 1), $id);
                            echo 'Success';
                        } elseif($status == 'unchacked') {
                            $this->exam_m->update_exam(array('active' => 0), $id);
                            
                            echo 'Success';
                        } else {
                            echo "Error";
                        }
                    } else {
                        echo 'Error';
                    }
                } else {
                    echo "Error";
                }
            } else {
                echo "Error";
            }
        } else {
            echo "Error";
        }
    }

    public function is_download() {
        if(permissionChecker('exam_edit')) {
            $id     = $this->input->post('id');
            $status = $this->input->post('status');
            if($id != '' && $status != '') {
                if((int)$id) {
                    
                    $exam = $this->exam_m->get_single_exam(array('examID' => $id));
                    if(customCompute($exam)) {
                        if($status == 'chacked') {
                            $this->exam_m->update_exam(array('is_download' => 1), $id);
                            echo 'Success';
                        } elseif($status == 'unchacked') {
                            $this->exam_m->update_exam(array('is_download' => 0), $id);
                            
                            echo 'Success';
                        } else {
                            echo "Error";
                        }
                    } else {
                        echo 'Error';
                    }
                } else {
                    echo "Error";
                }
            } else {
                echo "Error";
            }
        } else {
            echo "Error";
        }
    }



    }