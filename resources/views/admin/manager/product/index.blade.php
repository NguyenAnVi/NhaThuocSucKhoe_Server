@extends('admin.layouts.app')
@section('css')
<style>
	:root{
		--foreground1: #007710;
		--foreground1-table: #2c5732;
  	--foreground2: #8d7f00;
	}
	#list{
		width: 65%;
		padding: 0 12px 12px 12px;
		background-color: white;
	}
	#preview{
		width: 30%;
		padding: 0 12px 12px 12px;
		background-color: white;
	}
	.table-header{
		height: calc(80px);
		color: white;
		transform: translateY(-24px);
		padding:12px;
		border-radius: 5px;
		display: flex;
		align-items: center;
	}
	.wrapper {
  margin: 24px auto;
  /* padding: 40px; */
  /* max-width: 800px; */
}
.table {
  margin: 0 0 40px 0;
  width: 100%;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  display: table;
}
@media screen and (max-width: 580px) {
  .table {
    display: block;
  }
}
.row {
  display: table-row;
  background: #f6f6f6;
}
.row:nth-of-type(odd) {
  background: #e9e9e9;
}
.row.header {
  font-weight: 900;
  color: #ffffff;
  background: var(--foreground1-table);
}
@media screen and (max-width: 580px) {
  .row {
    padding: 14px 0 7px;
    display: block;
  }
  .row.header {
    padding: 0;
    height: 6px;
  }
  .row.header .cell {
    display: none;
  }
  .row .cell {
    margin-bottom: 10px;
  }
  .row .cell:before {
    margin-bottom: 3px;
    content: attr(data-title);
    min-width: 98px;
    font-size: 10px;
    line-height: 10px;
    font-weight: bold;
    text-transform: uppercase;
    color: #969696;
    display: block;
  }
}

.cell {
  padding: 6px 12px;
  display: table-cell;
}
@media screen and (max-width: 580px) {
  .cell {
    padding: 2px 16px;
    display: block;
  }
}
</style>
@endsection
@section('content')
	<h4 class="uk-padding-remove uk-margin-remove">{{$title}}</h4>

<div class="uk-margin-large-top uk-flex uk-flex-row uk-flex-between ">
	<div id="list" class="uk-border-rounded-10 uk-box-shadow-small">
		<div class="table-header uk-width-expand" style="background-color: var(--foreground1)">
			@lang('admin.product.tabletitle.productlist')
		</div>
		<div class="uk-flex uk-flex-wrap-between">
			<div class="uk-inline uk-width-expand">
				<a class="uk-form-icon" href="#" uk-icon="icon: search"></a>
				<input class="uk-input" type="text" aria-label="Clickable icon" placeholder="@lang('admin.product.button.search')">
			</div>
			<button class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1)" type="button">@lang('admin.product.button.addnew')</button>
		</div>
		<div>

			<div class="wrapper">
  
				<div class="table">
					
					<div class="row header">
						<div class="cell">
							Name
						</div>
						<div class="cell">
							Age
						</div>
						<div class="cell">
							Occupation
						</div>
						<div class="cell">
							Location
						</div>
					</div>
					
					<div class="row">
						<div class="cell" data-title="Name">
							Luke Peters
						</div>
						<div class="cell" data-title="Age">
							25
						</div>
						<div class="cell" data-title="Occupation">
							Freelance Web Developer
						</div>
						<div class="cell" data-title="Location">
							Brookline, MA
						</div>
					</div>
					
					<div class="row">
						<div class="cell" data-title="Name">
							Joseph Smith
						</div>
						<div class="cell" data-title="Age">
							27
						</div>
						<div class="cell" data-title="Occupation">
							Project Manager
						</div>
						<div class="cell" data-title="Location">
							Somerville, MA
						</div>
					</div>
					
					<div class="row">
						<div class="cell" data-title="Name">
							Maxwell Johnson
						</div>
						<div class="cell" data-title="Age">
							26
						</div>
						<div class="cell" data-title="Occupation">
							UX Architect & Designer
						</div>
						<div class="cell" data-title="Location">
							Arlington, MA
						</div>
					</div>
					
					<div class="row">
						<div class="cell" data-title="Name">
							Harry Harrison
						</div>
						<div class="cell" data-title="Age">
							25
						</div>
						<div class="cell" data-title="Occupation">
							Front-End Developer
						</div>
						<div class="cell" data-title="Location">
							Boston, MA
						</div>
					</div>
					
				</div>
				
				
			</div>
				
		</div>
	</div>
	<div id="preview" class="uk-border-rounded-10 uk-box-shadow-small">
		<div class="table-header uk-width-expand" style="background-color: var(--foreground2)">
			@lang('admin.product.tabletitle.preview')
		</div>
		<div class="uk-flex uk-flex-center">
			<div class="uk-padding-small uk-border-rounded-10 uk-width-1-2 imgprvdesk uk-box-shadow-small" style="border: 1px solid #757575;">
				<img id="imgpreview" class="uk-width-expand" src="https://genshin.honeyhunterworld.com/img/faruzan_076.webp" alt="">
			</div>
		</div>
	</div>
</div>
@endsection