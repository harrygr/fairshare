		<!-- if there are submission errors, show them here -->
      @if ( count($errors->all()) )
      <div class="alert alert-danger">
      <p>Some validation errors occurred:</p>
      <ul>
         @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
      </div>
      @endif