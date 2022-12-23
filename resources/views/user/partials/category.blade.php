
	<h4  style="color: black" class="">@lang('general.categories')</h4>
	<div class="uk-flex uk-flex-row uk-height-large">
		<style>
			.vi-hide-scrollbar::-webkit-scrollbar {
					width: 0px;
				}
		</style>
		<div class="vi-hide-scrollbar uk-margin-right uk-padding-small uk-border-rounded" style="overflow-y: overlay; background-color: #e5e5e5">
			<ul id="parent-categories" class="uk-nav uk-flex uk-flex-column uk-width-auto" uk-switcher="connect:#children-categories>.uk-switcher">
				{{-- PARENT-CATEGORIES --}}
				@foreach($categories as $item) @if($item->parent_id === 0)
				<li  data-target=".childs-of-{{$item->id}}">
					<button class="vi-frame uk-margin-small uk-button uk-button-primary uk-width-1-1 uk-text-left uk-padding-remove-vertical uk-padding-small">{{$item -> name}}</button>
				</li>
				@endif @endforeach
			</ul>    
		</div>
		<div uk-height-match="#parent-categories" id="children-categories"  style="overflow-y: overlay;">
			{{-- CHILD-CATEGORIES --}}
			<ul class="uk-switcher" >
			@foreach($categories as $parent_item) @if($parent_item->parent_id === 0)
				<li>
					<ul class="child-categories uk-nav uk-flex uk-flex-wrap uk-width-large">
						<style>
							.vi-frame-a{
								margin:5px;
								padding: 5px;
								border:none;
								border-radius: 5px;
								background-color: #e5e5e5;
							}
							.vi-frame-a:hover{
								background-color: #d5d5d5;
							}
						</style>
						@foreach($categories as $item) @if($item->parent_id === $parent_item->id)
						<li uk-height-match class="vi-frame-a uk-width-1-3 uk-width-1-4@m ">
							<div class="uk-height-1-1 uk-flex uk-flex-column uk-flex-between uk-child-width-1-1">
								<img src="{{$item-> imageurl}}" class="uk-margin-auto uk-margin-auto-horizontal" alt="{{$item->name}}">
								<p style="color: black; font-size:0.7rem;" class="uk-width-small uk-padding-remove-vertical uk-padding-small">{{$item -> name}}</p>

							</div>
							
						</li>
						@endif @endforeach

					</ul>    
				</li>
			@endif @endforeach
			</ul>
		</div>
	</div>