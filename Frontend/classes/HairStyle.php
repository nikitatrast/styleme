<?php
/*******************************************************
 * Project:     Admin-Portal-v2
 * File:        HairStyle.php
 * Author:      Your name
 * Date:        2020-06-27
 * Version:     1.0.0
 * Description:
 *******************************************************/

require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/browse.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/read.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/edit.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/add.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/delete.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/utils.php';

class HairStyle
{
    public int $id;
    public string $hairStyleName;
    public string $dateCreated;
    public string $dateModified;

    public function browse() {
        $this->sanitise();
        return browseResource('hair_styles');
    }

    public function read() {
        return readResource('hair_styles', Utils::sanitiseField($this->id, FILTER_SANITIZE_NUMBER_INT));
    }

    public function edit() {
        return editResource('hair_styles', array(
            'Id' => Utils::sanitiseField($this->id, FILTER_SANITIZE_NUMBER_INT),
            'hairStyleName' => Utils::sanitiseField($this->hairStyleName, FILTER_SANITIZE_STRING),
        ));
    }

    public function add() {
        return addResource('hair_styles', array(
            'hairStyleName' => Utils::sanitiseField($this->hairStyleName, FILTER_SANITIZE_STRING),
        ));
    }

    public function delete() {
        return deleteResource('hair_styles', Utils::sanitiseField($this->id, FILTER_SANITIZE_NUMBER_INT));
    }

    /**
     * Sanitises all relevant fields/properties of this class, including the ID
     */
    public function sanitise() {
        if (isset($this->id) &&
            isset($this->hairStyleName)
        ) {
            $this->id = Utils::sanitiseField($this->id, FILTER_SANITIZE_NUMBER_INT);
            $this->hairStyleName = Utils::sanitiseField($this->hairStyleName, FILTER_SANITIZE_STRING);
        }
    }

    /**
     * Handles form submission for the users page
     * @param  string  $method One of: 'POST', 'PUT' or 'DELETE'
     * @return string|null Alert message
     */
    public function handleSubmit($method = 'POST')
    {
        switch ($method) {
            case 'POST':
                if ($this->validatehairStyleName('add_hairStyleName')) {
                    // all good
                    $this->hairStyleName = $_POST['add_hairStyleName'];
                    $response = $this->add();

                    if (isset($response['status'])) {
                        switch($response['status']) {
                            case 400:
                                return Utils::createAlert('Invalid hair style name field', 'error');
                            case 500:
                                return Utils::createAlert('Could not add hair style. Please try again later', 'error');
                            case 200:
                            case 201:
                                return Utils::createAlert('Hair style successfully added', 'success');
                            default:
                                // unknown status
                                break;
                        }
                    }
                }
                else {
                    // add_hairStyleName field was removed from form
                    return Utils::createAlert('Hair style name cannot be empty', 'error');
                }
                break;

            case 'PUT':
                if (isset($_POST['put_id']) && is_numeric($_POST['put_id'])) {
                    if ($this->validatehairStyleName('put_hairStyle_hairStyleName')) {
                        $this->id = $_POST['put_id'];
                        $this->hairStyleName = $_POST['put_hairStyle_hairStyleName'];
                        $response = $this->edit();

                        if (isset($response['status'])) {
                            switch ($response['status']) {
                                case 400:
                                    return Utils::createAlert('Invalid hair style name. It cannot exceed 128 characters.', 'error');
                                case 404:
                                    return Utils::createAlert('Hair style not found.', 'error');
                                case 500:
                                    return Utils::createAlert('Could not updated hair style. Please try again later.', 'error');
                                case 200:
                                    return Utils::createAlert('Hair style successfully updated', 'success');
                                default:
                                    break;
                            }
                        }
                    }
                    else {
                        return Utils::createAlert('Hair style cannot be empty', 'error');
                    }
                }
                else {
                    return Utils::createAlert('Invalid hair style ID', 'error');
                }
                break;

            case 'DELETE':
                if (isset($_POST['delete_id']) && is_numeric($_POST['delete_id'])) {
                    $this->id = $_POST['delete_id'];

                    $response = $this->delete();

                    if (isset($response['status'])) {
                        switch ($response['status']) {
                            case 404:
                                return Utils::createAlert('Hair style was not found', 'error');
                            case 400:
                                return Utils::createAlert('Invalid hair style ID', 'error');
                            case 500:
                                return Utils::createAlert('Could not update hair style. Please try again later', 'error');
                            case 200:
                                return Utils::createAlert('Hair style successfully deleted', 'success');
                            default:
                                break;
                        }
                    }
                }
                else {
                    return Utils::createAlert('Invalid hair style ID field', 'error');
                }
                break;

            default:
                return Utils::createAlert('Invalid request method', 'error');
        }
        return null;
    }

    public function validatehairStyleName($hairStyleName) {
        return isset($_POST[$hairStyleName]) && is_string($_POST[$hairStyleName]) && !empty(trim($_POST[$hairStyleName]));
    }
}