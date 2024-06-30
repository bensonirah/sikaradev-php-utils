<?php

namespace SikaradevPhpUtils\File;

final readonly class CsvFileExport implements FileExportInterface
{
    public function __construct(private string $separator = ';')
    {
    }

    public function export(DataPayload $dataPayload, FilePath $filePath): void
    {
        $handle = fopen($filePath, 'w+');
        fputcsv($handle, $dataPayload->header(), $this->separator);
        $dataPayload->items(fn(array $item) => fputcsv($handle, $item, $this->separator));
        fclose($handle);
    }
}