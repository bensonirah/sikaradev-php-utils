<?php

namespace SikaradevPhpUtils\File;

interface FileExportInterface
{
    public function export(DataPayload $dataPayload, FilePath $filePath);
}