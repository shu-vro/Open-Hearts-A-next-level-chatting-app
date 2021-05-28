<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Document" />
    <meta name="description" content="Your Description..." />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="shortcut icon" href="resources/img/favicon.ico" type="image/x-icon" />
</head>

<body>
    <form class="shadow form" autocomplete="off">
        <h2>Verify:</h2>
        <div class="msg error">Lorem ipsum dolor sit amet.</div>
        <div class="inp_field shadow">
            <i class="fas fa-envelope">
                <span>
                    <h3>Email:</h3>
                    *Required and must be unique.
                </span>
            </i>
            <input class="inp" required type="email" name="email" placeholder="Email" />
        </div>
        <div class="inp_field shadow">
            <i class="fas fa-user">
                <span>
                    <h3>User Id:</h3>
                    *Required <br>
                    You got it when you first Singed in.
                </span>
            </i>
            <input class="inp" required type="text" name="unique_id" placeholder="Unique Id" />
        </div>
        <div class="inp_field shadow">
            <i class="fas fa-lock">
                <span>
                    <h3>New Password: </h3>
                    *Required <br>
                    Requirements:
                    <h3>
                        Uppercase,<br> Lowercase,<br> Number,<br> Minimum 8 characters.
                    </h3>
                </span>
            </i>
            <input class="inp" required type="password" name="password1" placeholder="New Password" />
            <i class="far fa-eye"></i>
        </div>
        <div class="inp_field shadow">
            <i class="fas fa-lock">
                <span>
                    <h3>Retype Password: </h3>
                    *Required <br>
                    Requirements:
                    <h3>
                        Uppercase,<br> Lowercase,<br> Number,<br> Minimum 8 characters.
                    </h3>
                </span>
            </i>
            <input class="inp" required type="password" name="password2" placeholder="Retype Password" />
            <i class="far fa-eye"></i>
        </div>

        <div class="inp_field shadow">
            <input type="submit" value="Change Password." />
        </div>
        New Here? Try <a href="register.php" class="normalBtn">Signing In.</a>
        Ready Now? <a href="index.php" class="normalBtn">Log In.</a>
    </form>
    <script src="resources/js/main.js"></script>
    <script src="resources/js/pass_strength.js"></script>
    <script>
        let form = document.querySelector('form'),
            submit = form.querySelector('input[type=submit]'),
            msg = form.querySelector('.msg');
        let shadow = '';
        for (let i = 0; i < 700; i++) {
            shadow += `${i}px ${i}px 0px #00000003, `;
        }
        form.setAttribute('style', `box-shadow: ${shadow} -3px -3px 15px #fff, -5px -5px 20px #fff;`);

        form.addEventListener('submit', (e) => {
            e.preventDefault();
        });

        submit.addEventListener('click', () => {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'resources/php/check_forgotten.php');
            xhr.addEventListener('readystatechange', () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let data = xhr.response;
                    msg.style.display = 'block';
                    msg.innerHTML = data;
                }
            })
            xhr.send(new FormData(form));
        });
    </script>
</body>

</html>