<?php

namespace App\Exports;

use App\Models\Sorteo;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SorteoExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
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
        $sorteos = Sorteo::orderBy('id');
		if($this->date_start != null) $sorteos = $sorteos->whereDate('created_at', '>=', $this->date_start);
		if($this->date_end != null) $sorteos = $sorteos->whereDate('created_at', '<=', $this->date_end);
		$sorteos = $sorteos->get();

		$sheet = [];
		foreach($sorteos as $sorteo) {
			$sheet[] = [
                $sorteo->created_at,
				$sorteo->nombres,
				$sorteo->apellidos,
				$sorteo->telefono,
				$sorteo->rut,
				$sorteo->email,
				$sorteo->vehiculo,
				$sorteo->n_boleta,
				$sorteo->serviteca,
				$sorteo->boleta,
			];
		}
		return $sheet;
    }

	public function headings(): array
    {
        return ['Fecha', 'Nombre', 'Apellidos', 'Teléfono', 'RUT', 'Correo', 'Vehículo', 'N° Boleta', 'Serviteca', 'Boleta URL',];
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
