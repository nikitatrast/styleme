<?php
/**********************************************************
 * Package: HairdressingProject
 * Project: Admin-Portal-v2
 * File: Colour.php
 * Author: Diego <20026893@tafe.wa.edu.au>
 * Date: 2020-06-26
 * Version: 1.0.0
 * Description: add short description of file's purpose
 **********************************************************/

require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/browse.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/read.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/edit.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/add.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/actions/delete.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/utils.php';

class Colour
{
    public int $id;
    public string $colourName;
    public string $colourHash;
    public string $dateCreated;
    public string $dateModified;

    public function browse() {
        return browseResource('colours');
    }

    public function read() {
        return readResource('colours', Utils::sanitiseField($this->id, FILTER_SANITIZE_NUMBER_INT));
    }

    public function edit() {
        return editResource('colours', array(
            'Id' => Utils::sanitiseField($this->id, FILTER_SANITIZE_NUMBER_INT),
            'ColourName' => Utils::sanitiseField($this->colourName, FILTER_SANITIZE_STRING),
            'ColourHash' => Utils::sanitiseField($this->colourHash, FILTER_SANITIZE_STRING)
        ));
    }

    public function add() {
        return addResource('colours', array(
            'ColourName' => Utils::sanitiseField($this->colourName, FILTER_SANITIZE_STRING),
            'ColourHash' => Utils::sanitiseField($this->colourHash, FILTER_SANITIZE_STRING)
        ));
    }

    public function delete() {
        return deleteResource('colours', Utils::sanitiseField($this->id, FILTER_SANITIZE_NUMBER_INT));
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
                if (Utils::validateField('add_colourName', 'string') &&
                    Utils::validateField('add_colourHash', 'string')) {
                    $this->colourName = $_POST['add_colourName'];
                    $this->colourHash = $_POST['add_colourHash'];

                    $response = $this->add();

                    return Utils::handleResponse(
                        $response,
                        [
                            '400' => 'Invalid colour name / hash',
                            '500' => 'Could not add colour. Please try again later.',
                            '200' => 'Colour successfully added'
                        ]
                    );
                }
                else {
                    return Utils::createAlert('Invalid colour name / hash fields', 'error');
                }
                break;

            case 'PUT':
                if (Utils::validateField('put_id', 'number')) {
                    if (Utils::validateField('put_colourName', 'string') && Utils::validateField('put_colourHash', 'string')) {
                        $this->id = $_POST['put_id'];
                        $this->colourHash = $_POST['put_colourHash'];
                        $this->colourName = $_POST['put_colourName'];

                        $response = $this->edit();

                        return Utils::handleResponse(
                            $response,
                            [
                                '400' => 'Invalid colour name / hash',
                                '404' => 'Colour not found',
                                '500' => 'Could not update colour. Please try again later.',
                                '200' => 'Colour successfully updated'
                            ]
                        );
                    }
                    else {
                        return Utils::createAlert('Colour name and hash cannot be empty', 'error');
                    }
                }
                else {
                    return Utils::createAlert('Invalid colour ID', 'error');
                }
                break;

            case 'DELETE':
                if (Utils::validateField('delete_id', 'number')) {
                    $this->id = $_POST['delete_id'];

                    $response = $this->delete();

                    return Utils::handleResponse(
                        $response,
                        [
                            '404' => 'Colour not found',
                            '500' => 'Could not delete colour. Please try again later.',
                            '200' => 'Colour successfully deleted'
                        ]
                    );
                }
                else {
                    return Utils::createAlert('Invalid colour ID', 'error');
                }
                break;

            default:
                return Utils::createAlert('Invalid request method', 'error');
        }
    }
}