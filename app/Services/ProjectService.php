<?php


namespace App\Services;


class ProjectService
{
    public static function checkDocumentType($documentType)
    {
        if ($documentType == 1) {
            return 'document_pdf_1';
        }
        if ($documentType == 2) {
            return 'document_pdf_2';
        }
        if ($documentType == 3) {
            return 'document_pdf_3';
        }

        return false;
    }

    public static function makeDocumentName($document_type)
    {
        $name = '';

        switch ($document_type) {
            case 0:
                return false;
            case 1:
                $name = 'Work Agreement, Architectural';
                break;
            case 2:
                $name = 'Engineering Service Contract';
                break;
            case 3:
                $name = 'Home Improvement Contract';
                break;
        }

        return $name;
    }
}