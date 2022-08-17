<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$date_start = $request->input('date_start') ?? date('Y-m-d', strtotime('-1 week'));
		$date_end = $request->input('date_end') ?? date('Y-m-d');
		$contacts = Contact::whereDate('created_at', '>=', $date_start)
		->whereDate('created_at', '<=', $date_end)
		->orderBy('id')
		->get();

		return view('dashboard')->with(['contacts' => $contacts, 'date_start' => $date_start, 'date_end' => $date_end]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validated = $request->validate([
			'nombre' => 'required',
			'email' => 'required|email',
		]);

        $contact = new Contact;
		$contact->nombre = $request->input('nombre');
		$contact->email = $request->input('email');
		$contact->flota = $request->input('flota');
		$contact->pais = $request->input('pais');
		$contact->ciudad = $request->input('ciudad');
		$contact->cantidad = $request->input('cantidad');
		$contact->empresa = $request->input('empresa');
		$contact->save();
		return $contact;
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
		$date_start = $request->input('date_start');
		$date_end = $request->input('date_end');
        return Excel::download(new ContactsExport($date_start, $date_end), 'contactos.xlsx');
    }
}
