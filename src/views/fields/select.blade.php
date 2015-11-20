<select class="form-control" id="{{ $row->id }}" name="{{ $row->name }}">
	@foreach ($row->args['values'] as $key => $value)
		<option value="{{ $key }}">{{ $value }}</option>
	@endforeach
</select>