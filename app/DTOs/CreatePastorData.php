<?php

namespace App\DTOs;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Logging\OpenTestReporting\Status;

class CreatePastorData
{
    public function __construct(
        public string $fname,
        public string $lname,
        public int $phone,
     //   public string $email,
        public string $region_id,
        public int $is_active,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            fname: $data['fname'],
            lname: $data['lname'],
            phone: $data['phone'],
        //    email: $data['email'],
            region_id: $data['region_id'],
            is_active: $data['is_active'],
        );
    }
}
