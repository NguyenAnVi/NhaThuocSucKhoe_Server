  <style>
    #search-results-has-results>ul>li[data-type="product"]{
      padding: 10px;
    }
    #search-results-has-results>ul>li[data-type="product"]:hover{
      background-color: var(--background-primary);
      border-radius: 10px;
    }
  </style>
  <form class="uk-search uk-search-default">
      <input class="uk-search-input" id="search" placeholder="@if(isset($search_suggest)){{$search_suggest}}@else @lang('general.search') @endif" autocomplete="off">
      <div style="width: 60vw" id="search-results" class="uk-dropdown uk-border-rounded" uk-dropdown="pos:bottom-right">
          <div id="search-results-has-results" style="max-height:400px; overflow-x:hidden; overflow-y: auto;" class="uk-nav uk-dropdown-nav uk-hidden">
            showing...
          </div>
          <ul id="search-results-has-no-result" class="uk-nav uk-dropdown-nav">
              <li>Nothing to show</li>
          </ul>
      </div>
  </form>