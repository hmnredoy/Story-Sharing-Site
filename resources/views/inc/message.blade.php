<script type="text/javascript">
	
window.setTimeout(function() {
    $("#custom_alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
	
</script>



  @if(session('message'))
  <div style="padding: 5px 5px;">
      <div class="{{session('style')}}" role="alert" id="custom_alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!! session()->get('message')!!} 
      </div>
  </div>
  @endif

@if(count($errors) > 0)
<div class="alert alert-danger" style="margin: 5px 5px;">
    @foreach ($errors->all() as $error)
	   {{ $error }}<br>
	@endforeach
</div>	
@endif

<!-- @if(session('comment_message'))
<div style="padding: 5px 5px;">
    <div class="{{session('style')}}" role="alert" id="custom_alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {!! session()->get('comment_message')!!} 
    </div>
</div>
@endif -->