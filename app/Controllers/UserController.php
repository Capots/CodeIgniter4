<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\User';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function showUser()
    {
        $data = [
            'message' => 'success',
            'data'    => $this->model->findAll()
        ];
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function createUser()
    {
        $rules = $this->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        };

        $this->model->insert([
            'username'  => esc($this->request->getVar('username')),
            'password'  => esc($this->request->getVar('password')),
        ]);
        
        $response = [
            'message'   => 'Successfully created'
        ];

        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function updateUser($id = null)
    {
        $rules = $this->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        };

        $this->model->update($id, [
            'username'  => esc($this->request->getVar('username')),
            'password'  => esc($this->request->getVar('password')),
        ]);
        
        $response = [
            'message'   => 'Successfully updated'
        ];

        return $this->respond($response,200);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function getById($id = null)
    {
        $data = [
            'message' => 'success',
            'result'  => $this->model->find($id)
        ];

        if ($data['result'] == null) {
            return $this->failNotFound('no records found');
        };

        return $this->respond($data, 200);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function deleteUser($id = null)
    {
        $this->model->delete($id);
        $response = [
            'message'   => 'Successfully deleted'
        ];

        return $this->respondDeleted($response);

    }
}
