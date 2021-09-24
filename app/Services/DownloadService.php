<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

// needs to implement DownloadableEntity
class DownloadService
{

    const DELIMITER = ";";

    public function dowloadAsCsv(Collection $data, string $filename)
    {
        return response()->streamDownload(function () use ($data) {
            foreach( $data as $row){
               echo implode(self::DELIMITER, $row->getCsvFields())."\n";
            }
        }, $filename.'.csv');
    }
}
