<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Posts extends ResourceController
{

    protected $modelName    = 'App\Models\PostModel';
    protected $format       = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
        $data = $this->request->getPost();

        $post = new \App\Entities\Post($data);
        $post->setSlug($data['title']);

        if(!$this->model->save($post)){
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated($post, 'post created');
    }

    public function show($id = null)
    {
        $record = $this->model->find($id);

        if (!$record) {
            return $this->failNotFound(sprintf(
                'post with id %d not found',
                $id
            ));
        }

        return $this->respond($record);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $post = new \App\Entities\Post($data);
        $post->setSlug($data['title']);
    
        if (!$this->model->save($post)) {
            # code...
            return $this->fail($this->model->errors());
        }

        return $this->respond($post, 200, 'post updated');
    }

    public function delete($id = null)
    {
        $delete = $this->model->delete($id);
        if ($this->model->db->affectedRows() === 0
        ) {
            return $this->failNotFound(sprintf(
                'post with id %id not found or already deleted',
                $id
            ));
        }

        return $this->respondDeleted(['id' => $id], 'post deleted');
    }
}
