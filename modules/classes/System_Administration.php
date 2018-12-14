<?php

class System_Administration extends Database {

    public function execute() {
        if ($_POST['action'] == "institution_self_registration") {
            return $this->institutionSelfRegistration();
        } else if ($_POST['action'] == "set_up_new_institution_business_environment") {
            return $this->setUpNewInstitutionBusinessEnvironment();
        }
    }

    public function sendHttpRequestPost($data_string) {
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $_SESSION["api_url"]);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl_session);
        curl_close($curl_session);
        return $response;
    }

    public function sendHttpRequestGet($data_string) {
        curl_setopt($curl_session, CURLOPT_URL, $_SESSION["api_url"] . $data_string);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl_session);
        curl_close($curl_session);
        return $response;
    }

    public function sendHttpRequestPut($data_string) {
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $_SESSION["api_url"] . $data_string);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $data_string);
        $response = curl_exec($curl_session);
        curl_close($curl_session);
        return $response;
    }
    
    public function checkIfInstitutionExists($institution_id) {
        $data['request_type'] = 'check_if_institution_exists';
        $data['institution_id'] = $institution_id;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $status = $decoded_response['status'];
        $info = $decoded_response['message'];
        if ($status == 200) {
            return true;
        } else if ($status == 500) {
            return false;
        }
    }

    public function checkIfEmailExists($email) {
        $data['request_type'] = 'check_if_email_exists';
        $data['email'] = $email;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $status = $decoded_response['status'];
        $info = $decoded_response['message'];
        if ($status == 200) {
            return true;
        } else if ($status == 500) {
            return false;
        }
    }

    private function institutionSelfRegistration() {
        $data['request_type'] = $_POST['action'];
        $data['company_name'] = $_POST['organization_name'];
        $data['country'] = $_POST['country'];
        $data['business_type'] = $_POST['organization_business_type'];
        $data['registration_date'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        $data['package'] = $_POST['package'];
        $data['firstname'] = $_POST['firstname'];
        $data['lastname'] = $_POST['lastname'];
        $data['phone_number'] = $_POST['phone_number'];
        $data['email'] = $_POST['email'];

        $data_string = http_build_query($data);
        
        if (!empty($data['request_type']) && !empty($data['company_name']) && !empty($data['business_type']) && !empty($data['firstname']) && !empty($data['email'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }
    
    private function setUpNewInstitutionBusinessEnvironment() {
        $data['request_type'] = "set_up_new_institution_business_environment";
        $data['institution'] = $_SESSION['created_institution_id'];
        if(isset($_SESSION["branches_list"])) {
            $data['business_branches'] = $_SESSION["branches_list"];
        } else {
            $data['business_branches'] = 'N/A';
        }
        if(isset($_SESSION["positions_list"])) {
            $data['business_positions'] = $_SESSION["positions_list"];
        } else {
            $data['business_positions'] = 'N/A';
        }
        if(isset($_SESSION["loan_types_list"])) {
            $data['business_loan_types'] = $_SESSION["loan_types_list"];
        } else {
            $data['business_loan_types'] = 'N/A';
        }
        if(isset($_SESSION["loan_processing_fees_list"])) {
            $data['business_loan_processing_fees'] = $_SESSION["loan_processing_fees_list"];
        } else {
            $data['business_loan_processing_fees'] = 'N/A';
        }

        $data_string = http_build_query($data);
        
        argDump($data_string);
        argDump($data_string);
        exit();
        
        if (!empty($data['request_type']) && !empty($data['business_branches']) && !empty($data['business_positions']) && !empty($data['business_loan_types']) && !empty($data['business_loan_processing_fees'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }
        
    public function updateInstitutionSetupStatus() {
        $data['request_type'] = "update_institution_setup_status";
        $data['institution'] = $_SESSION['created_institution_id'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['institution'])) {            
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }
        
    public function getInstalmentFrequencies() {
        $data['request_type'] = 'get_instalment_frequencies';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['instalment_frequency']) && $_POST['instalment_frequency'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['instalment_frequency']) && $_POST['instalment_frequency'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }

        if ($html == "")
            $html = "<option value=\"\">No instalment frequency entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getBusinessForms() {
        $data['request_type'] = 'get_business_forms';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['business_form']) && $_POST['business_form'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['business_form']) && $_POST['business_form'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }

        if ($html == "")
            $html = "<option value=\"\">No business form entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getStaqpesaPackages() {
        $data['request_type'] = 'get_staqpesa_packages';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['package']) && $_POST['package'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['package']) && $_POST['package'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No staqpesa package entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

    public function getPartnerCountries() {
        $data['request_type'] = 'get_partner_countries';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['country']) && $_POST['country'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['country']) && $_POST['country'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No partner country entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }
    
    public function getAllPartnerCountries() {
        $data['request_type'] = 'get_all_partner_countries';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllStaqpesaPackages() {
        $data['request_type'] = 'get_all_staqpesa_packages';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchPartnerCountryDetails($code) {
        $data['request_type'] = 'fetch_partner_country_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchStaqpesaPackageDetails($code) {
        $data['request_type'] = 'fetch_staqpesa_package_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateInstitution($code, $update_type, $approval_comment) {
        $data['request_type'] = 'update_institution';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['approval_comment'] = $approval_comment;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

}
