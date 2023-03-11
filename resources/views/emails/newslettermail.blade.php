<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        html,
        body {
            background: #eeeeee;
            font-family: 'Open Sans', sans-serif, Helvetica, Arial;
        }
        img {
            max-width: 100%;
        }
        /* This is what it makes reponsive. Double check before you use it! */
        @media only screen and (max-width: 480px) {
            table tr td {
                width: 100% !important;
                float: left;
            }
        }
        .font-raleway {
            font-family: 'Raleway', sans-serif;
        }
        .font-bold {
            font-weight: 700;
        }
        .font-normal {
            font-weight: 400;
        }
        .inline-flex {
            display: inline-flex !important;
        }
        .items-center {
            align-items: center !important;
        }
        .p-1 {
            padding: 0.25rem
                /* 4px */
                 !important;
        }
        .bg-blue {
            --tw-bg-opacity: 1 !important;
            background-color: rgb(52, 152, 219) !important;
        }
        .text-sm {
            font-size: 0.875rem
                /* 14px */
                 !important;
            line-height: 1.25rem
                /* 20px */
                 !important;
        }
        .text-white {
            --tw-text-opacity: 1 !important;
            color: rgb(255 255 255) !important;
        }
        .uppercase {
            text-transform: uppercase !important;
        }
        .tracking-widest {
            letter-spacing: 0.1em !important;
        }
        .hover\:bg-white:hover {
            --tw-bg-opacity: 1 !important;
            background-color: rgb(255 255 255) !important;
        }
        .border {
            border-width: 1px !important;
        }
        .border-eve {
            --tw-border-opacity: 1 !important;
            border-color: rgb(230 57 70) !important;
        }
        .hover\:border:hover {
            border-width: 1px !important;
        }
        .hover\:border-eve:hover {
            --tw-border-opacity: 1 !important;
            border-color: rgb(230 57 70) !important;
        }
        .hover\:text-eve:hover {
            --tw-text-opacity: 1 !important;
            color: rgb(230 57 70) !important;
        }
        .w-full {
            width: 100% !important;
        }
        .justify-center {
            justify-content: center !important;
        }
        .text-eve {
            --tw-text-opacity: 1 !important;
            color: rgb(230 57 70) !important;
        }
        .text-lg {
            font-size: 1.125rem
                /* 18px */
                 !important;
            line-height: 1.75rem
                /* 28px */
                 !important;
        }
        .p-5 {
            padding: 1.25rem
                /* 20px */
                 !important;
        }
        .mt-4 {
            margin-top: 1rem
                /* 16px */
                 !important;
        }
        .mt-12 {
            margin-top: 3rem
                /* 48px */
                 !important;
        }
        .my-12 {
            margin-top: 3rem
                /* 48px */
                 !important;
            margin-bottom: 3rem
                /* 48px */
                 !important;
        }
        .leading-6 {
            line-height: 1.5rem
                /* 24px */
                 !important;
        }
        .bg-adam-light {
            --tw-bg-opacity: 1 !important;
            background-color: rgb(237 242 244) !important;
        }
        @media (min-width: 640px) {
            .sm\:px-5 {
                padding-left: 1.25rem
                    /* 20px */
                     !important;
                padding-right: 1.25rem
                    /* 20px */
                     !important;
            }
            .sm\:py-4 {
                padding-top: 1rem
                    /* 16px */
                     !important;
                padding-bottom: 1rem
                    /* 16px */
                     !important;
            }
        }
    </style>
</head
<body style="background: #eeeeee; padding: 10px; font-family: 'Open Sans', sans-serif, Helvetica, Arial;">
    <center>
        <!-- ** Table begins here
    ----------------------------------->
        <!-- Set table width to fixed width for Outlook(Outlook does not support max-width) -->
        <table width="100%" cellpadding="0" cellspacing="0" bgcolor="FFFFFF"
            style=" max-width: 600px !important; margin: 0 auto; background-color:transparent;">
            <tr>
                <td style="padding: 20px; text-align: center;">
                    <img src="{{asset('logo.png')}}" alt="" srcset="" width="196px">
                </td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: center;" class="bg-blue">
                    <h1 style="color: #ffffff" class="text-white font-raleway uppercase font-bold">{{$newsletter->subject}}</h1>
                </td>
            </tr>

            <tr style="background-color: #ffffff;">
                <td style="padding:20px;">
                    @if ($newsletter->image)
                    <div style="margin-bottom: 20px">
                        <img src="{{asset($newsletter->image)}}" alt="" width="100%">
                    </div>
                    @endif
                    <div style="margin-bottom: 20px;">
                        {{ $newsletter->text }}
                    </div>
                    <center>
                        <a href="{{$newsletter->link ? $newsletter->link : 'https://www.thevirtualbd.com'}}" target="_blank" style="display: inline-block; background-color: #3490dc; color: #fff; padding: 10px 20px; text-decoration: none;">Visit</a>
                    </center>
                </td>
            </tr>

            <tr class="bg-adam-light">
                <td>
                    <p style="text-align: center; color: #666666; font-size: 12px; margin: 20px 0;">
                        Copyright © 2023. All&nbsp;rights&nbsp;reserved.<br />
                    </p>
                </td>
            </tr>

        </table>

    </center>
</body>

</html>
