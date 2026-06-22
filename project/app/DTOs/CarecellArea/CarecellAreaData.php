<?php

namespace App\DTOs\CarecellArea;

class CarecellAreaData
{
    public function __construct(
        public string $area_name,
        public ?string $area_description,
        public int $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            area_name:        $data['area_name'],
            area_description: $data['area_description'] ?? null,
            is_active:        (int) $data['is_active'],
        );
    }
}
