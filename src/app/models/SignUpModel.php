<?php

declare (strict_types = 1);

namespace App\Models;

use App\Model;
use Throwable;

class SignUpModel extends Model
{
    public function __construct(protected UserModel $userModel, protected InvoiceModel $invoiceModel) 
    {
        parent::__construct();
        
    }

    public function register(array $userInfo, array $invoiceInfo)
    {
        try {
            /*using prepare instead of query which is more secure combined with placeholders or named parameters */
            $this->db->beginTransaction();
 
            $userId = $this->userModel->create($userInfo['email'], $userInfo['name']);
            $invoiceId = $this->invoiceModel->create($invoiceInfo['amount'], $userId);

            /*the commit method finishes the transaction and makes it permanent if no error was found */
            $this->db->commit();
            } catch (Throwable $e) {
                if (! $this->db->inTransaction()) {
                    $this->db->rollBack();
                }
                throw $e;
            }
        return $invoiceId;
    }
}