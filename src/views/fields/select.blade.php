<select class="form-control" id="{{ $row->id }}" name="{{ $row->name }}">
	@if (empty($row->args['values']))
		<option>Nothing to select</option>
	@else
		@foreach ($row->args['values'] as $key => $value)
			@if (!$key))
			<option value="0">Please select...</option>
			@else
			<option value="{{ $key }}" @if ($row->value == $key) selected @endif>{{ $value }}</option>
			@endif
		@endforeach
	@endif
</select>