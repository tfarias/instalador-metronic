<a target="_blank" href="{{ request()->fullUrl() }}{{ strpos(request()->fullUrl(), '?') !== false ? '&' : '?' }}acao=imprimir&relformato=pdf" toggle="tooltip" title="Imprimir" class="btn btn-default">
    <i class="fa fa-print"></i>
</a>

<a target="_blank" href="{{ request()->fullUrl() }}{{ strpos(request()->fullUrl(), '?') !== false ? '&' : '?' }}acao=imprimir&relformato=xls" toggle="tooltip" title="Exportar" class="btn btn-default">
    <i class="fa fa-table"></i>
</a>

<button type="submit" title="Pesquisar" class="btn btn-default" id="btn-filter" toggle="tooltip" name="acao" value="filtrar">
    <i class="fa fa-search"></i>
</button>