<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>[SUBJECT]</title>
    <style type="text/css">

        #outlook a {
            padding: 0;
        }

        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }

        #backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        img {
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
            display: inline-block;
        }

        .image_fix {
            display: block;
        }

        h1, h2, h3, h4, h5, h6 {
            color: black !important;
        }

        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
            color: blue !important;
        }

        h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {
            color: red !important;
        }

        h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
            color: purple !important;
        }

        table td {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        a {
            color: #000;
        }

        @media only screen and (max-device-width: 480px) {

            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: black; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #048eff !important; /* or whatever your want */
                pointer-events: auto;
                cursor: default;
            }
        }

        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: blue; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #139aff !important;
                pointer-events: auto;
                cursor: default;
            }
        }

        p {
            margin: 0;
            color: #555;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 160%;
        }

        a.link2 {
            text-decoration: none;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            color: #fff;
            border-radius: 4px;
        }

        h2 {
            color: #181818;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 22px;
            font-weight: normal;
        }

        .bgItem {
            background: #1285f4;
        }

        .bgBody {
            background: #ffffff;
        }

    </style>

    <script type="colorScheme" class="swatch active">
  {
    "name":"Default",
    "bgBody":"ffffff",
    "link":"f2f2f2",
    "color":"555555",
    "bgItem":"F4A81C",
    "title":"181818"
  }


    </script>

</head>
<body>
<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
<table cellpadding="0" width="100%" cellspacing="0" border="0" id="backgroundTable" class='bgBody'>
    <tr>
        <td>

            <!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->

            <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%"
                   style="border-collapse:collapse;">
                <tr>
                    <td class='movableContentContainer'>

                        <div class='movableContent'>
                            <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%"
                                   style="border-collapse:collapse;">
                                <tr>
                                    <td style="color:#fff;" class='bgItem'>
                                        <table cellpadding="0" style="border-collapse:collapse;" cellspacing="0"
                                               border="0" align="center" width="600">
                                            <tr>
                                                <td width="200" style="vertical-align:bottom;">
                                                    <div class="contentEditableContainer contentImageEditable">
                                                        <div class="contentEditable">
                                                            <div style="padding-top:20px;text-align:center;">
                                                                <img src="{{asset('img/6@2x.png')}}" width="148"
                                                                     data-default="placeholder" data-max-width="200"
                                                                     style="margin-bottom:-3px;"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td width="400" valign="top"
                                                    style="padding-top:40px;padding-bottom:20px;">
                                                    <br/>
                                                    <div class="contentEditableContainer contentTextEditable">
                                                        <div class="contentEditable">
                                                            <div style="font-size:23px;font-family:Heveltica, Arial, sans-serif;color:#fff;">
                                                                Funds Received Successful
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="contentEditableContainer contentTextEditable">
                                                        <div class="contentEditable"
                                                             style="padding:20px 10px 0 0;margin:0;font-family:Helvetica, Arial, sans-serif;font-size:15px;line-height:150%;">
                                                            <p style='color:#FFEECE;'>Hi {{$receiverName}}, <br/>

                                                                I send you $ {{$amount}} cash from my account to
                                                                your {{$receiverEmail}}. Please check your account and
                                                                confirm me.


                                                            </p>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class='movableContent'>
                            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
                                <tr>
                                    <td width="100">&nbsp;</td>
                                    <td width="400" align="center" style="padding-top:25px;padding-bottom:115px;">
                                        <table cellpadding="0" cellspacing="0" border="0" align="center" width="200"
                                               height="50">
                                            <tr>
                                                <td bgcolor="#ED006F" align="center" style="border-radius:4px;"
                                                    width="200" height="50">
                                                    <div class="contentEditableContainer contentTextEditable">
                                                        <div class="contentEditable">
                                                            <a target='_blank' href="{{url('/login')}}" class='link2'>Login Your Account Now</a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="100">&nbsp;</td>
                                </tr>
                            </table>
                        </div>

                        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

                                <tr>
                                    <td align='left'>
                                        <div class="contentEditableContainer contentTextEditable">
                                            <div class="contentEditable" align='center'>
                                                <p>
                                                    <br>
                                                    <br>
                                                    Cheers,
                                                    <br>
                                                    <span style='color:#222222;'>{{$senderName}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </div>


                    </td>
                </tr>
            </table>
            <!-- END BODY -->

        </td>
    </tr>
</table>
<!-- End of wrapper table -->
</body>
</html>
