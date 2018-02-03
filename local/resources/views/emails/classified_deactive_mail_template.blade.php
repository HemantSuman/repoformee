<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Make an offer</title>
    </head>
    <body>
        <center>
            <table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">

                <tr>
                    <td colspan="3">
                        <!--CONTENT STARTS HERE-->
                        <br />
                        <br />
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding-right:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" valign="top">
                                    <span style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold;">Dear {{$dataSendInMail->contact_name}}</span>
                                    <br />
                                    <p>The following Ad posted by you have been found in violation of our Terms & Conditions, therefore we are deactivating it.</p>
                                    <br/><br/><br/>
                                    <table width="100%" style="border: 2px solid #000">
                                        <tr>
                                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Classified ID</th>
                                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Classified Name</th>
                                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Category</th>
                                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Sub Category</th>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $dataSendInMail->id }}</td>
                                            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $dataSendInMail->title }}</td>
                                            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{$dataSendInMail->categoriesname['name']}}</td>
                                            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{$dataSendInMail->Subcategoriesname['name']}}</td>
                                        </tr>
                                    </table>
                                    <br/>
                                    Thanks,<br/>
                                    Support
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />

        </center>
    </body>
</html>