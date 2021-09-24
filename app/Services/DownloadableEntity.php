<?php

namespace App\Services;

interface DownloadableEntity {
    public function getCsvFields(): array;
}
