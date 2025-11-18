<%
strBody = "Request Information" & chr(10) & chr(10)
strBody = strBody & "Sent on:  " & WeekDayName(WeekDay(Date), true) & ", " & Day(Date) & " " & MonthName(Month(Date), true) & " " & Year(Date) & " " & FormatDateTime(Now, 4) & chr(10)
strBody = strBody & "Company:  " & Request.Form("co") & chr(10)
strBody = strBody & "First Name:  " & Request.Form("fname") & chr(10)
strBody = strBody & "Last Name:  " & Request.Form("lname") & chr(10)
strBody = strBody & "Street Address:  " & Request.Form("street") & chr(10)
strBody = strBody & "City:  " & Request.Form("city") & chr(10)
strBody = strBody & "State:  " & Request.Form("state") & chr(10)
strBody = strBody & "Zip Code:  " & Request.Form("zip") & chr(10)
strBody = strBody & "Area Code:  " & Request.Form("area") & chr(10)
strBody = strBody & "Phone:  " & Request.Form("phone") & chr(10)
strBody = strBody & "E-Mail Address:  " & Request.Form("email") & chr(10)
strBody = strBody & "Operating System:  " & Request.Form("os") & chr(10)
strBody = strBody & "Graphics Application:  " & Request.Form("app") & chr(10)
 
Set Mailer = Server.CreateObject("SMTPsvg.Mailer")
Mailer.AddRecipient "InkRockit Printed Samples Request","clay@clayg.com"
%><!--Mailer.AddRecipient "Request from, wpmh.org, a baby's place page","cynthia.galvan@flhosp.org"--><%
%><!-- Mailer.AddRecipient "Request from, wpmh.org, a baby's place page","saajida.karim@flhosp.org" --><%
Mailer.Subject   =  "InkRockit Printed Samples Request"
Mailer.BodyText  = strBody
Mailer.RemoteHost = "mail.imageteam.com"
Mailer.FromAddress = "request@inkrockit.com"

if Mailer.SendMail then
  Response.Write "<script language='javascript'>window.open('sent.html','_self');</script>"
else
  Response.Write "<script language='javascript'>window.open('error.html','_self');</script>" & Mailer.Response
end if
%>
