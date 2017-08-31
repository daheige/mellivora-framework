@if ($paginator->hasPages())
<div class="row">
    <div class="col-md-3">
        <div style="margin:20px 0; line-height: 20px;">
        @php
            echo __('Page :current of :pages, Found total :total records', [
                ':current' => '<b class="text-success">' . $paginator->currentPage() . '</b>',
                ':pages'   => '<b class="text-success">' . $paginator->totalPages() . '</b>',
                ':total'   => '<b class="text-success">' . $paginator->total() . '</b>',
            ]);
        @endphp
        </div>
    </div>
    <div class="col-md-9" style="text-align:right;">
        {{ $paginator->render('pagination.digg') }}
    </div>
</div>
@endif
