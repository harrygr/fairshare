<footer id="footer">
	<div class="container">

		<div class="col-md-6">
			<div class="footer-item social-links">
				<span>
					<div class="fb-like" data-href="{{ URL::action('home') }}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
				</span>
				<span>
					<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
				</span>
				<span>
					<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="120"></div>
				</span>
			</div>
		</div>

		<div class="col-md-6 text-right ">
			<p class="muted credit">FairShare project on {{ HTML::link('https://github.com/harrygr/larpay', 'Github') }}. </p>
			<p class="text-muted small">Front page image credit: {{ HTML::link('https://www.flickr.com/photos/100915417@N07/', 'Charlie Marshall' ) }}</p>
		</div>

	</div>
</footer>
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'); }}
{{-- HTML::script('js/bootbox.min.js') --}}
{{-- HTML::script('//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js') --}}
{{-- HTML::script('//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js') --}}
{{ HTML::script('js/larpay.scripts-ck.js'); }}
{{ HTML::style('//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css') }}
@yield('scripts')
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

window.___gcfg = {lang: 'en-GB'};

(function() {
	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/platform.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
</body>
</html>