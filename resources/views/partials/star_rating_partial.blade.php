@if(isset($star_rating))
	@for ($i = 1; $i <= 5; $i++)
		@if($star_rating >= $i)
			<i class="mdi mdi-star mr-1 text-warning"></i>
		@else
			<i class="fe fe-star mr-1 text-warning"></i>
		@endif
	@endfor
@endif