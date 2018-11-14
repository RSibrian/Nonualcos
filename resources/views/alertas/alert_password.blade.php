@if (Session::has('sin_pass'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">
            &times;
        </button>
        <ul>
            <li>
                {{Session::get('sin_pass')}}
            </li>
        </ul>
    </div>
@endif
