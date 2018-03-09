<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Login:</strong>
            {!! Form::text('login', null, array('placeholder' => 'Login','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>E-mail:</strong>
            {!! Form::text('email', null, array('placeholder' => 'E-mail','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Group:</strong>
            @php
                $groups = array();
            @endphp
            @foreach ($group as $item)
                @php
                    $groups[$item->groupId] = $item->name;
                @endphp
            @endforeach
            {!! Form::select('groupId', $groups, null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password confirmation:</strong>
            {!! Form::password('password_confirmation', array('placeholder' => 'password confirmation','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</div>
