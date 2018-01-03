	<div class="container">
		@if(!empty($news))
		<div id="news">
		  <h3>{{{ trans('texts.lastest_news')}}}</h3>
		  <p><a href="<?=url('/page/all-news')?>">+ Show all news<i class="icon-arrow-right-5"></i></a></p>
		    <table class="table noborder">
		    	@foreach($news as $new)
		    	<tr>
					<td>{{date('Y-m-d',strtotime($new->created_at))}}</td>
					<td>{{ HTML::link('/post/'.$new->permalink, $new->title) }}</td>
				</tr>
				@endforeach
		    </table>
		</div>
		@endif
</div>
@section('script.footer')
@parent
<script>
jQuery( document ).ready(function($) {
    $("#news_twitter_feed").find('.timeline-header.customisable-border').css('background-color','#00a651');
    $("#news_twitter_feed").find('.timeline-header .summary a').css('color','#fff');
});
</script>
@stop
