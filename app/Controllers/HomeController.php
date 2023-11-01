<?php

declare (strict_types = 1);

namespace App\Controllers;

use App\App;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Attributes\Route;
use App\Container;
use App\Models\InvoiceModel;
use App\Models\SignUpModel;
use App\Models\User;
use App\Models\UserModel;
use App\Services\InvoiceService;
use App\Views;
use Exception;
use PDO;
use PDOException;
use RuntimeException;
use Throwable;

class HomeController
{   

    public function __construct(private InvoiceService $invoiceService) {
    }

    

    public function methodForLearningContainer(): Views
    {
        $this->invoiceService->process([], 25);
        
        return Views::make('methodForLearningContainer');
    }
    #[Route('/')]
    #[Route(routePath:'/home')]
    #[Route(routePath: '/si')]
    public function index(): Views
    {   
        throw new RuntimeException('Test');

        return Views::make('index');
    }

    public function download()
    {
        /*this header is specifying that the type of the content will be a pdf */
        header('Content-Type: application/pdf');
        /*This header instructs the browser to treat the file as an attachment and prompts the user to download it. */
        header('Content-Disposition: attachment;filename="sampleEE.pdf"');
        /*reads the contents of the PDF file (sample.pdf) and sends it to the browser for download */
        readfile(STORAGE_PATH . '/sample.pdf');
    }

    public function upload()
    {



        /*In these lines, two variables filePath and filePath2 are defined. They are assigned the value of the concatenation of the STORAGE_PATH constant (which represents the storage directory path) with the respective names of the uploaded files. The $_FILES superglobal is used to access the uploaded files and their properties. */
        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];


        /*These lines are responsible for moving the uploaded files from their temporary location to the designated storage path. The move_uploaded_file() function is used for this purpose. It takes two arguments: the temporary file path (retrieved from $_FILES['receipt']['tmp_name'] and $_FILES['myImage']['tmp_name']) and the destination file path (stored in $filePath and $filePath2). This function ensures that the uploaded files are securely moved to the desired location. */
        move_uploaded_file($_FILES['receipt']['tmp_name'],$filePath);

        header('Location: /invoices');
    }
    
    #[Post('/')]
    public function store()
    {

    }

    #[Put('/')]
    public function update()
    {

    }
}
