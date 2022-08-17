<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contactos') }}
        </h2>
    </x-slot>

	<div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="p-6 bg-white border-b border-gray-200 flex justify-between">
					<div>
						Desde <input type="date" name="date_start" id="date_start" value="{{ $date_start }}">
					</div>
					<div>
						Hasta <input type="date" name="date_end" id="date_end" value="{{ $date_end }}">
					</div>
					<button type="submit" class="bg-indigo-500 rounded text-white px-8 py-2">Filtrar</button>
				</form>
			</div>
		</div>
	</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<div class="text-right pb-6 text-indigo-500"><a href="{{ url('contactos/exportar') . '?date_start=' . $date_start . '&date_end=' . $date_end }}">Exportar Excel</a></div>
					<table class="w-full">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Correo</th>
								<th>Flota/Empresa</th>
								<th>País</th>
								<th>Ciudad</th>
								<th>Cantidad</th>
								<th>Nombre empresa y capacitador</th>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $contact)
							<tr>
								<td>{{ $contact->nombre }}</td>
								<td>{{ $contact->email }}</td>
								<td>{{ $contact->flota }}</td>
								<td>{{ $contact->pais }}</td>
								<td>{{ $contact->ciudad }}</td>
								<td>{{ $contact->cantidad }}</td>
								<td>{{ $contact->empresa }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
