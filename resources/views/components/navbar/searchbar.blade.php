  <form class="uk-search uk-search-default">
      <input class="uk-search-input" id="search" placeholder="@if(isset($search_suggest)){{$search_suggest}}@else @lang('general.search') @endif">
      <div id="search-results" class="uk-dropdown uk-width-expand uk-border-rounded" uk-dropdown>
          <div id="search-results-has-results" style="max-height:500px; overflow-x:hidden; overflow-y: auto;" class="uk-nav uk-dropdown-nav uk-hidden">
            showing...
          </div>
          <ul id="search-results-has-no-result" class="uk-nav uk-dropdown-nav">
              <li>Nothing to show</li>
          </ul>
      </div>
  </form>