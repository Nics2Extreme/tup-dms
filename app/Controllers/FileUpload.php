<?php

namespace App\Controllers;

use App\Models\Documents;

class FileUpload extends BaseController
{
    public function getIndex()
    {
        return view('home');
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
            print_r('Choose a valid file');
        } else {
            $sender = $this->request->getPost('sender');
            $receipient = $this->request->getPost('receipient');
            $subject = $this->request->getPost('subject');
            $description = $this->request->getPost('description');
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');
            $values = [
                'name' =>  $img->getName(),
                'type'  => $img->getClientMimeType(),
                'sender' => $sender,
                'receipient' => $receipient,
                'subject' => $subject,
                'description' => $description,
            ];

            $documentModel = new Documents();
            $query = $documentModel->insert($values);
            if (!$query) {
                return  redirect()->to('compose')->with('fail', 'Something went wrong.');
            } else {
                return redirect()->to('compose')->with('success', 'Document successfully created.');
            }
        }
    }
}
