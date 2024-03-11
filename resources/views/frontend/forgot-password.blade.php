<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexo - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <style>
        body {
            font-family: 'Mulish', sans-serif;
            background-color: #f3f4f6;
        }

        #login-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-area {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
            height: 150px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        .login-fields {
            margin-top: 20px;
        }

        .head {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .group-input {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    {{-- ======================================
                    LOGIN FORM
    ======================================= --}}

    <section id="login-form">
        <div class="form-area">
            <div class="logo">
                <img src="{{ asset('user/images/logo.png') }}" alt="..." class="w-100 h-100">
            </div>
            <p>We Will send a link to your email,use that link to reset password.</p>
            <form action="{{route('forget.password.post')}}" method="POST">
                @csrf

                <div class="login-fields">
                    <div class="head">Enter Your E-Mail</div>

                    <div class="group-input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                        <div id="emailError" style="color: red;"></div>
                    </div>
                    <div class="group-input">
                    <button type="submit" onclick="return validateForm()">Submit</button>

                    </div>
                    <!-- <div class="head">Enter Your OTP</div>

                    <div class="group-input">
                        <label for="otp">Enter OTP</label>
                        <input type="number" name="otp">
                    </div> -->

                    <!-- <div class="group-input">
                        <input type="submit" value="Login">
                    </div> -->

                </div>
            </form>
        </div>
    </section>


    {{-- ======================================
                    SCRIPT TAGS
    ======================================= --}}
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="{{ asset('user/js/index.js') }}"></script>
    <script>
      function validateForm() {
    var email = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.trim() === '') {
        emailError.innerText = 'Email is required';
        return false;
    } else if (!emailRegex.test(email)) {
        emailError.innerText = 'Invalid email format';
        // Display alert message
        alert('Invalid email format. Please enter a valid email address.');
        return false;
    } else {
        emailError.innerText = '';
        return true;
    }
}

    </script>
</body>

</html>
