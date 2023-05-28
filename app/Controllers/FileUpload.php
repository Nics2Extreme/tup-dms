<?php

namespace App\Controllers;

use App\Models\Documents;
use App\Models\Users;

class FileUpload extends BaseController
{
    function getAdminCompose()
    {
        return view('dashboard/admin/create');
    }

    function getUserCompose()
    {
        return view('dashboard/user/usercreate');
    }

    function upload()
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
            $sender = $this->request->getPost('sender');
            $receipient = $this->request->getPost('receipient');
            $subject = $this->request->getPost('subject');
            $description = $this->request->getPost('description');
            $type = "document";
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');

            $userModel = new Users();
            $query = $userModel->select('id')->where('name', $receipient)->find();
            $data = [
                'id' => $query[0]['id']
            ];
            $id = $data['id'];

            $values = [
                'name' =>  $img->getName(),
                'type'  => $img->getClientMimeType(),
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
                return redirect()->back()->with('success', 'Document successfully created.');
            }
        }
    }

    function download($name)
    {
        $file = WRITEPATH . 'uploads/' . $name;

        if (is_file($file)) {
            $mime = mime_content_type($file);

            // Set the appropriate headers
            header('Content-Type: ' . $mime);
            header('Content-Disposition: attachment; filename=' . $name);
            header('Content-Length: ' . filesize($file));

            // Output the file content
            readfile($file);
            exit();
        } else {
            // PDF file not found, handle error
            echo 'PDF file not found.';
        }
    }
}
