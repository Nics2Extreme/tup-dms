<?php

namespace App\Controllers;

use App\Models\Documents;
use App\Models\Users;

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

    public function getUserRequest()
    {
        return view('dashboard/user/userrequest');
    }

    public function getAdminRequest()
    {
        return view('dashboard/admin/request');
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
        $data = [
            'status' => 1
        ];
        $result = $documentModel->where('id', $id)->update($id, $data);
        print_r($result);
        return redirect()->back()->with('success', 'Successfully received.');
    }

    function request()
    {
        helper(['form', 'url']);
        $database = \Config\Database::connect();
        $db = $database->table('files');

        $sender = $this->request->getPost('sender');
        $receipient = $this->request->getPost('receipient');
        $subject = $this->request->getPost('subject');
        $description = $this->request->getPost('description');
        $type = "request";

        $userModel = new Users();
        $query = $userModel->select('id')->where('name', $receipient)->find();
        $data = [
            'id' => $query[0]['id']
        ];
        $id = $data['id'];

        $values = [
            'sender' => $sender,
            'receipient_id' => $id,
            'receipient' => $receipient,
            'subject' => $subject,
            'description' => $description,
            'action' => $type
        ];

        $documentModel = new Documents();
        $query = $documentModel->insert($values);
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong.');
        } else {
            return redirect()->back()->with('success', 'Request successfully sent.');
        }
    }

    function send()
    {
        helper(['form', 'url']);
        $database = \Config\Database::connect();
        $db = $database->table('files');
        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,application/pdf]',
                'max_size[file, 2048000]',
            ]
        ]);

        if (!$input) {
            return redirect()->back()->with('fail', 'Please upload a file.');
        } else {
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');

            $id = $this->request->getPost('id');
            $documentModel = new Documents;
            $data = [
                'name' =>  $img->getName(),
                'type'  => $img->getClientMimeType(),
                'status' => 1
            ];
            $result = $documentModel->where('id', $id)->update($id, $data);

            if (!$result) {
                return  redirect()->back()->with('fail', 'Something went wrong.');
            } else {
                return redirect()->back()->with('success', 'Document successfully created.');
            }
        }
    }
}
