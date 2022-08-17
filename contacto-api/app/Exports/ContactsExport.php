<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ContactsExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
	protected $date_start;
	protected $date_end;

	function __construct($date_start, $date_end) {
		$this->date_start = $date_start;
		$this->date_end = $date_end;
	}

	/**
    * @return array
    */
    public function array(): array
    {
        $contacts = Contact::orderBy('id');
		if($this->date_start != null) $contacts = $contacts->whereDate('created_at', '>=', $this->date_start);
		if($this->date_end != null) $contacts = $contacts->whereDate('created_at', '<=', $this->date_end);
		$contacts = $contacts->get();

		$sheet = [];
		foreach($contacts as $contact) {
			$sheet[] = [
				$contact->created_at,
				$contact->nombre,
				$contact->email,
				$contact->flota,
				$contact->pais,
				$contact->ciudad,
				$contact->cantidad,
				$contact->empresa,
			];
		}
		return $sheet;
    }

	public function headings(): array
    {
        return ['Fecha', 'Nombre', 'Correo', 'Flota', 'País', 'Ciudad', 'Cantidad', 'Empresa'];
	}
	
	public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
            },
        ];
    }
}
