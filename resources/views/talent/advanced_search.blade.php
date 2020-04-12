@extends('templates.advance_search_template')

@if(property_exists($data[0],'cabecera_title')) 
	@section('title', $data[0]->cabecera_title)
@endif

@section('content')

<div class="container-fluid">


<div class="row row-alta">


		<div class="col-md-8 row-alta2" style="background-image:url('{{ URL::asset('img/mapa.png') }}');">
			<!--<div class="img-map-points" style="background-image:url('{{ URL::asset('img/mapa.png') }}');">-->
				<h2 class="titleadvancesearch">Connecting talents<br>&nbsp;&nbsp;&nbsp;&nbsp; and Scouts</h2>
				<button class="btn btn-primary boton-azul btnadvsearch"><b>Search</b></button>
			<!--</div>-->
		</div>

		<div class="col-md-4">

			<p class="liketosearch-title letraextragrande">What would you like to search?</p>

			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="user_type" name="user_type" class="form-control">
			      <option value="1">Talent</option>
			      <option value="2">Recruiter</option>
			      <option value="3">Job</option>
			    </select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="category" name="category" class="form-control">
			      <option value="1">Category</option>
			    </select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="subcategory" name="subcategory" class="form-control">
			      <option value="1">Subcategory</option>
			    </select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="ages" name="ages" class="form-control">
			      <option value="1" selected>Age Range</option>
			      <option value="2">13 - 19</option>
			      <option value="3">20 - 29</option>
			      <option value="4">30 - 39</option>
			      <option value="5">40+</option>
			    </select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="level" name="level" class="form-control">
			      <option value="1">Experienced Level</option>
			    </select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="country" name="country" class="form-control">
			      <option value="1">Country</option>
			    </select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="state" name="state" class="form-control">
			      <option value="1">State</option>
			    </select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group elemsearch">
			  <div class="col-md-12">
			    <select id="city" name="city" class="form-control">
			      <option value="1">City</option>
			    </select>
			  </div>
			</div>

			<div class="col-md-12">
				<a href="#" class="bluelnk">clear filters</a>
			</div>
	</div>


</div>

</div>

@endsection