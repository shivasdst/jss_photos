<?php

class viewHelper extends View {

    public function __construct() {

    }

    public function getDetailByField($json = '', $firstField = '', $secondField = '') {

        $data = json_decode($json, true);

        if (isset($data[$firstField])) {
      
            return $data[$firstField];
        }
        elseif (isset($data[$secondField])) {
      
            return $data[$secondField];
        }

        return '';
    }

    public function getPhotoCount($id = '') {

        $count = sizeof(glob(PHY_PHOTO_URL . $id . '/*.json'));
        return ($count > 1) ? $count . ' Photographs' : $count . ' Photo';
    }

    public function getActualID($combinedID) {

        return preg_replace('/^(.*)__/', '', $combinedID);
    }
    
    public function includeRandomThumbnail($id = '') {

        $photos = glob(PHY_PHOTO_URL . $id . '/thumbs/*.jpg');
        $randNum = rand(0, sizeof($photos) - 1);
        $photoSelected = $photos[$randNum];

        return str_replace(PHY_PHOTO_URL, PHOTO_URL, $photoSelected);
    }

    public function displayFieldData($json, $auxJson='') {

        $data = json_decode($json, true);
        
        if ($auxJson) $data = array_merge($data, json_decode($auxJson, true));
        
        if(isset($data['id'])) {

            $data['id'] = $data['albumID'] . '/' . $data['id'];
            unset($data['albumID']);
        }

        $html = '';
        $html .= '<ul class="list-unstyled">';

        foreach ($data as $key => $value) {

        if($value != ""){
            
                if(preg_match('/keyword/i', $key)) {

                    $html .= '<li class="keywords"><strong>' . $key . ':</strong><span class="image-desc-meta">';
                    
                    $keywords = explode(',', $value);
                    foreach ($keywords as $keyword) {
       
                        $html .= '<a href="' . BASE_URL . 'search/field/?description=' . trim($keyword) . '">' . str_replace(' ', '&nbsp;', trim($keyword)) . '</a> ';
                    }
                    
                    $html .= '</span></li>' . "\n";
                }
                else{

                    $html .= '<li><strong>' . $key . ':</strong><span class="image-desc-meta">' . $value . '</span></li>' . "\n";
                }
            }
        }

        // $html .= '<li>Do you know details about this picture? Mail us at heritage@iitm.ac.in quoting the image ID. Thank you.</li>';

        $html .= '</ul>';

        return $html;
    }
    public function insertReCaptcha() {

        require_once('vendor/recaptchalib.php');

        $publickey = "6Le_DBsTAAAAACt5YrgWhjW00CcAF0XYlA30oLPc";
        $privatekey = "6Le_DBsTAAAAAH8rvyqjPXU9jxY5YJxXct76slWv";

        echo recaptcha_get_html($publickey);
    }

    public function displayDataInForm($json, $auxJson='') {

        $data = json_decode($json, true);
        
        if ($auxJson) $data = array_merge($data, json_decode($auxJson, true));
        
        $count = 0;
        $formgroup = 0;

        foreach ($data as $key => $value) {
            // echo "Key: $key; Value: $value\n";
            $disable = (($key == 'id') || ($key == 'albumID'))? 'readonly' : '';
            echo '<div class="form-group" id="frmgroup' . $formgroup . '">' . "\n";
            echo '<input type="text" class="form-control" name="id'. $count . '[]"  value="' . $key . '"' . $disable  . ' />&nbsp;' . "\n";
            echo '<input type="text" class="form-control" name="id'. $count . '[]"  value="' . $value . '"' . $disable . ' />' . "\n";
            if($disable != "readonly"){
                echo '<input type="button"  onclick="removeUpdateDataElement(\'frmgroup'. $formgroup .'\')" value="Remove" />' . "\n";                
            }
            echo '</div>' . "\n";
            $count++;
            $formgroup++;
        }

        echo '<div id="keyvalues">' . "\n";
        echo '</div>' . "\n";
        echo '<input type="button" id="keyvaluebtn" onclick="addnewfields(keyvaluebtn)" value="Add New Fields" />' . "\n";
        echo '<input type="submit" id="submit" value="Update Data" />' . "\n";
    }

}

?>
