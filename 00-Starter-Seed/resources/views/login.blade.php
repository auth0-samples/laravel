@extends('layouts.master')

@section('content')

    <script src="https://cdn.auth0.com/js/lock/10.2/lock.min.js"></script>
    <script type="text/javascript">
        var lock = new Auth0Lock('{{ $auth0Config['client_id'] }}', '{{ $auth0Config['domain'] }}');

        var lock = new Auth0Lock(
          '{{ $auth0Config['client_id'] }}',
          '{{ $auth0Config['domain'] }}',
          {
            auth: {
                redirectUrl: '{{ $auth0Config['redirect_uri'] }}',
                responseType: 'code',
                params: {
                    scope: 'openid name email picture'
                }
            }
          }
        );

        lock.show();
    </script>

@stop