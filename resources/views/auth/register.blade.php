<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up — Mangools eBook</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.10.0/dist/tabler-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>

  {{-- Background blobs --}}
  <div class="blob b1"></div>
  <div class="blob b2"></div>
  <div class="blob b3"></div>
  <div class="blob b4"></div>

  <div class="card">
    <h1>Sign up and start reading</h1>
    <p class="subtitle">Create your Mangools eBook account in seconds.</p>
<form method="POST" action="{{ route('register.store') }}">
    @csrf
    {{-- Email --}}
    <div class="field">
      <label for="email">Your email</label>
      <div class="input-wrap" id="emailWrap">
        <i class="ti ti-mail" aria-hidden="true"></i>
        <input type="email" name="email" placeholder="e.g. elon@tesla.com" autocomplete="email">
      </div>
    </div>

    {{-- Password --}}
    <div class="field">
      <label for="pw">Password</label>
      <div class="input-wrap" id="pwWrap">
        <i class="ti ti-lock" aria-hidden="true"></i>
        <input id="pw"  type="password" name="password" placeholder="e.g. ilovemangools123" autocomplete="new-password">
        <button class="toggle-btn" id="togglePw" type="button" aria-label="Toggle password visibility">
          <i class="ti ti-eye-off" id="eyeIcon"></i>
        </button>
      </div>
      <div class="strength-bars" id="strengthBars">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <p class="hint">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</p>
    </div>

    {{-- First & Last name --}}
    <div class="name-row">
      <div class="field">
        <label for="fname">First name</label>
        <div class="input-wrap">
          <i class="ti ti-user" aria-hidden="true"></i>
          <input id="fname" type="text" name="first_name" placeholder="e.g. Elon" autocomplete="given-name">
        </div>
      </div>
      <div class="field">
        <label for="lname">Last name</label>
        <div class="input-wrap">
          <i class="ti ti-user" aria-hidden="true"></i>
          <input id="lname" type="text" name="last_name" placeholder="e.g. Musk" autocomplete="family-name">
        </div>
      </div>
    </div>

    {{-- Terms of Service --}}
    <div class="tos">
      <input type="checkbox" id="tos">
      <span>
        <label for="tos">I agree to the </label>
        <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
      </span>
    </div>

    {{-- Submit --}}
    <button class="btn-primary" id="createBtn"  type="submit">Create account</button>

    <div class="divider">or</div>

    {{-- Google --}}
    <button class="btn-google" type="button">
      <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615Z" fill="#4285F4"/>
        <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18Z" fill="#34A853"/>
        <path d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332Z" fill="#FBBC05"/>
        <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58Z" fill="#EA4335"/>
      </svg>
      Sign up with Google
    </button>

    <p class="footer">Already have an account? <a href="#">Sign in</a></p>
  </div>
</form>
  <script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>