<?php

namespace App\Controllers;

use App\Models\Documents;

class DocumentController extends BaseController
{

    public function getUserDocument()
    {
        return view('dashboard/user/userdocument');
    }

    public function getAdminDocument()
    {
        return view('dashboard/admin/document');
    }

    function getDocument($id)
    {
        $documentModel = new \App\Models\Documents;
        $query['document'] = $documentModel->find($id);
        return $this->response->setJSON($query);
    }

    function getDocuments()
    {
        $documentModel = new \App\Models\Documents;
        $query['documents'] = $documentModel->findAll();

        return $this->response->setJSON($query);
    }

    function getUserDocuments($name)
    {
        $documentModel = new \App\Models\Documents;
        $query['documents'] = $documentModel->where('receipient_id', $name)->findAll();

        return $this->response->setJSON($query);
    }

    function receive()
    {
        $id = $this->request->getPost('id');
        $documentModel = new Documents;
        $query['documents'] = $documentModel->select('status')->where('id', $id)->find();
        $data = [
            'status' => 1
        ];
        $documentModel->update($id, $data);
        return redirect()->back()->with('success', 'User successfully registered.');
    }
}
