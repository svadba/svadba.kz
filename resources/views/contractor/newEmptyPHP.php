            @if(Request::old('phones'))
            @foreach(Request::old('phones') as  $phone)
            @if($phone)
            <div class="form-group">
              <div class="form-group input-group">
                <input type="text" name="phones[]" id="phone" value="{{$phone}}" placeholder ="Телефон" class="form-control"/>  
              </div>
              <script>
                $(document).on('click', '.btn-add', function(event) {
                  event.preventDefault();

                  var field = $(this).closest('.form-group');
                  var field_new = field.clone();

                  $(this)
                  .toggleClass('btn-success')
                  .toggleClass('btn-add')
                  .toggleClass('btn-danger')
                  .toggleClass('btn-remove')
                  .html('✖');

                  field_new.find('input').val('');
                  field_new.insertAfter(field);
                });

                $(document).on('click', '.btn-remove', function(event) {
                  event.preventDefault();
                  $(this).closest('.form-group').remove();
                });
              </script>
            </div>     
            @endif
            @endforeach
            @endif