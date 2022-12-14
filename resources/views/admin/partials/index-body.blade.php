<div>
    @includeIf($tableView, ['collection'=>$collection])
</div>
<div>
    {{$collection -> links()}}
</div>