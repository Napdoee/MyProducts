<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Verify Email</title>
    <!-- CSS files -->
    @include('templates.partials.head')
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <div class="card">
          <div class="card-body">
            <h2 class="card-title mb-2">Verify Email</h2>
            <p class="card-title text-muted mb-4">Oops, hold on! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
            @if (session('status') == 'verification-link-sent')
                <p class="text-muted mb-4">A new verification link has been sent to the email address you provided during registration.</p>
            @endif
            <div class="form-footer d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                  <button type="submit" class="btn btn-primary w-100">
                    Send Verification Email
                  </button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                  <button type="submit" class="btn btn-outline-primary w-100">
                    Logout
                  </button>
                </form>
            </div>
          </div>
        </div>
        <div class="text-center text-muted mt-3">
          Forget it, <a href="{{ route('home') }}">send me back</a> to the home page.
        </div>
      </div>
    </div>
    <!-- JS -->
    @include('templates.partials.script')
  </body>
</html>