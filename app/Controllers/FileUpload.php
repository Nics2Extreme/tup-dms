<?php

namespace App\Controllers;

use App\Models\Documents;
use App\Models\Users;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

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
            $documentModel = new Documents();
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
                'action' => $type,
            ];
            $query = $documentModel->insert($values);
            $this->createQr($id);

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

    function createQr($id){
            $documentModel = new Documents();
            $query = $documentModel->select('id')->where('receipient_id', $id)->find();
            $doc = [
                'id' => $query[0]['id']
            ];
            $doc_id = $doc['id'];

            $writer = new PngWriter();
            $qrCode = QrCode::create(base_url('documents/' . $doc_id))
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->setSize(300)
                ->setMargin(10)
                ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255));

            // Create generic logo
            $logo = Logo::create('cos.png')
            ->setResizeToWidth(50);

            $result = $writer->write($qrCode, $logo);

            // Save it to a file
            $result->saveToFile(ROOTPATH  . 'public/src/qrcode' . $doc_id . '.png');

            // Generate a data URI to include image data inline (i.e. inside an <img> tag)
            $dataUri = $result->getDataUri();

            $data = [
                'qr' =>  $dataUri
            ];
            $result = $documentModel->where('id', $doc_id)->update($doc_id, $data);
    }
}
