<div class="toast-container position-static">
</div>

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast-template">
  <div class="toast-header">
    <strong class="me-auto">Mysh&rsquo;t</strong>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>

<script>
class Toast {
	static id = 1;
	static notify( message ) {
		let template = $( '#toast-template' );
		let toast    = template.clone();
		toast.attr({ 'id' : Toast.id });
		$( '.toast-container' ).append( toast );
		toast.children( '.toast-body' ).text( message );
		toast = new bootstrap.Toast( toast );
		toast.show();
		Toast.id++;
	}
}
</script>
