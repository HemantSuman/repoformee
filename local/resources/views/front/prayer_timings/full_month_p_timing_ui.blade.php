@if(!empty($timings_data))
<table class="table table-bordered timing-table"  id="fixTable">
	<thead>
		<tr>
			<th class="date">
				Date</th>
			</th>
			<th class="fajr">
				<img src="{{ URL:: asset('/plugins/front/img/icons/maghrib-icon.png') }}" alt="h-icons">
				<span>Fajr</span>
			</th>
			<th class="dhuhr">Dhuhr
				<img src="{{ URL:: asset('/plugins/front/img/icons/dhuhr.png') }}" alt="h-icons">
			</th>

			<th class="asr">Asr
				<img src="{{ URL:: asset('/plugins/front/img/icons/asr.png') }}" alt="h-icons">
			</th>

			<th class="maghrib">
				<img src="{{ URL:: asset('/plugins/front/img/icons/maghrib-icon.png') }}" alt="h-icons"><span>Maghrib</span>
			</th>
			<th class="isha">Isha
				<img src="{{ URL:: asset('/plugins/front/img/icons/isha.png') }}" alt="h-icons">
			</th>
		</tr>
	</thead>

	@foreach($timings_data as $day => $timings)
		<tr>
			<td>{{ $day }}</td>
			<td>{{ $timings[0] }}</td>
			<td>{{ $timings[2] }}</td>
			<td>{{ $timings[3] }}</td>
			<td>{{ $timings[5] }}</td>
			<td>{{ $timings[6] }}</td>
		</tr>
	@endforeach
</table>
@endif