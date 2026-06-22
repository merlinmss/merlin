<?php

namespace App\DTOs\CarecellLeader;

class CarecellLeaderData
{
    public function __construct(
        public string $fname,
        public string $lname,
        public ?string $phone,
        public ?string $email,
        public int $leader_role,
        public int $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            fname:       $data['fname'],
            lname:       $data['lname'],
            phone:       $data['phone'] ?? null,
            email:       $data['email'] ?? null,
            leader_role: (int) $data['leader_role'],
            is_active:   (int) $data['is_active'],
        );
    }
}
