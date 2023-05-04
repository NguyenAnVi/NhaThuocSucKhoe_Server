<style>
    :root{
    --foreground1: #540073;
    --foreground1-table: #481582;
    --foreground2: #003067;
    --foreground2-table: #14007a;

  }
  #list{
    /* width: 55vw; */
    padding: 0 12px 12px 12px;
    margin: 0 12px 0 0;
    background-color: white;
  }
  #preview{
    overflow: hidden;
    background-color: white;
    width: 0%;
    transition: width 1s ease;
  }
  .table-header{
    width: 560px;
    height: calc(80px);
    color: white;
    transform: translateY(-24px);
    padding:12px;
    border-radius: 5px;
    display: flex;
    align-items: center;
  }
  .wrapper {
    max-width: 100%;
    box-sizing: border-box;
    display: flex;
    border-radius: 5px;
    overflow: auto;
  }
  .table {
    width: 100%;
    display: table;
  }
  .row {
    display: table-row;
    background: #f6f6f6;
    cursor: pointer;
  }
  .row:nth-of-type(odd) {
    background: #e9e9e9;
  }
  .row.header {
    font-weight: 900;
    color: #ffffff;
    background: var(--foreground1-table);
  }
  .row.search.header {
    font-weight: 900;
    color: #ffffff;
    background: var(--foreground2-table);
  }
  .row:hover:not(.header){
    background-color: rgb(156, 255, 179);
  }
  .row.on-search:hover:not(.header){
    background-color: rgb(255, 252, 156) !important;
  }
  .cell {
    padding: 6px 12px;
    display: table-cell;
    white-space: nowrap; 
    text-overflow:ellipsis; 
    overflow: hidden;
  }
  #search-results{
    min-width: 750px;
  }
  #upload-image-img{
    width: 30%; height:30%; object-fit:cover;
  }
  [data-role=values]{
    padding-bottom: 10px;
  }
  [data-role=values]:nth-of-type(odd){
    padding-right: 5px;
  }
  [data-role=values]:nth-of-type(even){
    padding-left: 5px;
  }
</style>