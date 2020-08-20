<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\ContactEmail;
use App\Models\ContactPhone;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactsImport implements ToCollection
{
    use Importable;
    public $campaign_id;
    public $created_by;
    public $assigned_user_id;
    public $company_id;

    public function __construct($campaign_id, $created_by, $assigned_user_id, $company_id)
    {
        $this->campaign_id = $campaign_id;
        $this->created_by = $created_by;
        $this->assigned_user_id = $assigned_user_id;
        $this->company_id = $company_id;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $contact = Contact::create([
                'first_name' => $row[0],
                'middle_name' => $row[1],
                'last_name' => $row[2],
                'assigned_user_id' => $this->assigned_user_id,
                'created_by_id' => $this->created_by,
                'campaign_id' => $this->campaign_id,
                'company_id' => $this->company_id,
                'status' => 1
            ]);

            $contact_id = $contact->id;

            ContactEmail::create([
                'email' => $row[3],
                'contact_id' => $contact_id
            ]);

            ContactPhone::create([
                'phone' => $row[4],
                'contact_id' => $contact_id
            ]);
        }
    }
}
