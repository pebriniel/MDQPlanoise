<?php

Class MediaUpload {


    public function saveUpload($field_name){

        if (is_null($field_name)){
            die('Need field_name');
             }
            $uploaded_file = $this->handleUpload($_FILES[$field_name]);

            if(!isset($uploaded_file['file'])){
                return false;
            }

            $guid = $this->buildGuid($uploaded_file['file']);

            $attachment = array(
                'post_mime_type' => $_FILES[$field_name]['type'],
                'guid' => $guid,
                'post_title' => 'Uploaded : ' . $_FILES[$field_name]['name'],
                'content' => '',
                'post_status' => 'inherit',
                'post_date' => date('Y-m-d H:i:s')
            );

            $attach_id = wp_insert_attachment($attachment, $uploaded_file['file']);

            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            $meta = wp_generate_attachment_metadata($attach_id, $uploaded_file['file']);

            wp_update_attachment_metadata($attach_id, $meta);

            $uploaded_feedback = false;

            return $attach_id;

}

    public function handleUpload($file = array()){
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        return wp_handle_upload($file, array('test_form' => false), date('Y/m/'));

    }

    public function buildGuid($file = null){
        $wp_upload_dir = wp_upload_dir();
        return $wp_upload_dir ['baseurl'] . '/' . _wp_relative_upload_path($file);

    }





}