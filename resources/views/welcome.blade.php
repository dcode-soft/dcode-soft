<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mypresets</title>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('public/css/normalize.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/coustom.css') }}">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-D6J4M1R6PZ"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-D6J4M1R6PZ');
        </script>
    </head>
    <body>
        <canvas id="world"></canvas>

        <div class="content">
            <h1>Hey Folks</h1>
            <h2>We are going live on</h2>
            <div id="countdown" data-time="2022/04/29 01:00:00"></div><!-- change data-time -->
            <h2>Till then visit this page on every Thursday for new Premier/FCP Project, Luts and Reels project.</h2>
            <form action="{{ route('subscribe') }}" method="post" class="contact-form" id="contact-form">
                @csrf
                <div class="field-wrap">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email Address..">
                </div>
                <div class="button-wrap">
                    <input type="submit" id="submit-form" value="Submit">
                </div>
            </form>
        </div>
        <script src="{{ asset('public/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('public/js/coustom.js') }}"></script>
        <script type="text/javascript">
        $(document).delegate('#contact-form', 'submit', function(event) {
            event.preventDefault();

            $form = $(this);
            $btn = $form.find('#submit-form');
            $btn_html = $btn.val();
            $.ajax({
                url: $form.attr('action'),
                method: $form.attr('method'),
                data: $form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $btn.prop('disabled', true);
                    $btn.val('Loading...');
                },
                success: function(json) {
                    if (json.success) {
                        location.href = json.redirect;
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                },
                complete: function() {
                    $btn.prop('disabled', false);
                    $btn.val($btn_html);
                },
                error: function(response) {
                    $form.find('.text-danger').remove();
                    json_error_handling($form, response.responseJSON.errors);
                }
            });
        });
        </script>
    </body>
</html>