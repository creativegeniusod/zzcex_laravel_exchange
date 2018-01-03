<!-- Orders History -->
@section('title')
{{{ trans('texts.transfer_out')}}}
@stop
<?php
$query_string = '';
foreach (Request::query() as $key => $value) {
    if($key!='pager_page')
    $query_string .= $key."=".$value."&";
}
$query_string = trim($query_string,'&');
if(!empty($query_string)) $query_string = "&".$query_string;
?>
<div id="transferout">
    <h2>{{{ trans('texts.transfer_out')}}} @if(isset($current_coin)) {{' - '.$current_coin}} @endif</h2>
    @if($filter=='')
    <form class="form-inline" method="GET" action="{{Request::url()}}">
        <div class="form-group text size1">
            <label for="pair">{{{ trans('texts.wallet')}}}</label>
            <select id="pair" style="margin-right: 20px;" name="wallet" class="form-control">
                <option value="" @if(isset($_GET['wallet']) == '') selected @endif>{{trans('texts.all')}}</option>
                @foreach($wallets as $key=> $wallet)
                    <option value="{{$wallet['id']}}" @if(isset($_GET['wallet']) && $_GET['wallet']==$wallet['id']) selected @endif>{{ $wallet['type']}}</option>
                @endforeach
            </select>
        </div>
            <button type="submit" class="btn btn-primary" name="do_filter">{{trans('texts.filter')}}</button>
    </form>
    @endif
    <table class="table table-striped hovered">
        <thead>
        <tr>
            <th>{{{ trans('texts.wallet')}}}</th>
            <th>{{{ trans('texts.receiver')}}}</th>
            <th>{{{ trans('texts.amount')}}}</th>
            <th>{{{ trans('texts.date')}}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transferouts as $transferout)
            <tr>
                <td>{{$transferout->type}}</td>
                <td>{{$transferout->username}}</td>
                <td>{{sprintf('%.8f',$transferout->amount)}}</td>
                <td>{{$transferout->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="pager"></div>
</div>
@section('script.footer')
@parent
{{ HTML::script('assets/js/bootstrap-paginator.js') }}
<script type="text/javascript">
var options = {
        currentPage: <?php echo $cur_page ?>,
        totalPages: <?php echo $total_pages ?>,
        alignment:'right',
        pageUrl: function(type, page, current){
            <?php
            if(empty($filter)){ ?>
            return "<?php echo URL::to('user/profile/viewtranferout'); ?>"+'?pager_page='+page+'<?php echo $query_string ?>';
        <?php }else{ ?> return "<?php echo URL::to('user/profile/viewtranferout').'/'.$filter; ?>"+'?pager_page='+page+'<?php echo $query_string ?>';
         <?php } ?>
        }
    }
    $('#pager').bootstrapPaginator(options);
    $('#pager').find('ul').addClass('pagination');
</script>
@stop
