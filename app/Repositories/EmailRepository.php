<?php

namespace App\Repositories;

use App\Models\CategoryEmail;
use App\Models\Email;
use Illuminate\Support\Facades\DB;

class EmailRepository  extends BaseRepository
{
    public function byCompany(int $companyId, int $perPage = 0)
    {
        $mails = Email::where('company_id', '=', $companyId);
        return $perPage > 0 ? $mails->paginate($perPage) : $mails->get();
    }

    public function search(string $search, int $companyId, int $perPage = 0)
    {
        $mails = Email::orWhere('name', 'ilike', "%$search%")
                      ->where('company_id', $companyId)
                      ->orWhere('email', 'ilike', "%$search%")
                      ->where('company_id', $companyId);
        
        return $perPage > 0 ? $mails->paginate($perPage)->appends(['search' => $search]) : $mails->get();
    }

    public function byId(int $id)
    {
        return Email::findOrFail($id);
    }

    public function store(array $data)
    {
        return Email::create($data);
    }

    public function update(int $id, array $data)
    {
        $mail = $this->byId($id);
        $mail->update($data);

        return $mail;
    }

    public function destroy(int $id)
    {
        $mail = $this->byId($id);
        $mail->delete();

        return true;
    }

    public function disassossiateAllEmails(int $categoryId)
    {
        DB::table('category_emails')->where('category_id', '=', $categoryId)->delete();
    }

    public function assossiateEmails(array $emailIds, int $categoryId)
    {
        foreach($emailIds as $emailId) {
            CategoryEmail::create(['category_id' => $categoryId, 'email_id' => $emailId]);
        }
    }
}