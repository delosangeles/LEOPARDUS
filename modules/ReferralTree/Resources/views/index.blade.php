@extends('layouts.app')

@section('content')
	<link rel="stylesheet" href="{{ Module::asset('ReferralTree:js/jquery-hortree/dist/jquery.hortree.css') }}">

	<style>
		
		.hortree-wrapper *, .hortree-wrapper *:before, .hortree-wrapper *:after {
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		}

		.hortree-wrapper {
		  position: relative;
		  font-family: sans-serif, Verdana, Arial;
		  font-size: 0.9em;
		}

		.hortree-branch {
		  position: relative;
		  margin-left: 180px;
		}

		.hortree-branch:first-child { margin-left: 0; }

		.hortree-entry {
		  position: relative;
		  margin-bottom: 50px;
		}

		.hortree-label {
		  display: block;
		  width: 150px;
		  padding: 2px 5px;
		  line-height: 30px;
		  text-align: center;
		  border: 2px solid #4b86b7;
		  border-radius: 3px;
		  position: absolute;
		  left: 0;
		  z-index: 10;
		  background: #fff;
		}
	</style>
    <div id="my-container"></div>	
@stop

@section('scripts')
	<script src="//code.jquery.com/jquery.min.js"></script>
	<script src="{{ Module::asset('ReferralTree:js/jquery-hortree/src/jquery.hortree.js') }}"></script>
	<script src="{{ Module::asset('ReferralTree:js/jquery-line/jquery.line.js') }}"></script>

	<script>
		$.getJSON('{{ url("referraltree/getReferreds") }}', function (jsonData) {
		  $('#my-container').hortree({
		    data: jsonData
		  });
		});
	</script>
@stop
